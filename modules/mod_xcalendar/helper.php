<?php
// classe del modulo
class modXcalendarHelper
{
	// metodo della classe
	function getStamp($params)
	{

		$catid = $params->get('mcatid');
		$location = $params->get('location');
		$time = $params->get('time');
		$number = $params->get('number');
		if (!$_GET['page']){
			$start='0';
		}
		if ($_GET['page']){
			$start = $number*($_GET['page']-1);
		}
		$template=$params->get('template');
		$format= $params->get('format');
		$itemid= $params->get('itemid');
		
		
		$date_start=date('Y-m-d');
		if($_GET['date']) $date_start=JRequest::getVar( "date", "", "GET", "STRING");
		// preparo la query
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		
		// seleziono le voci
		$query->select(
			'e.id, e.title, e.params, e.catid, e.image, e.file, e.dates, e.time, e.desc, l.address as address, l.name as location_name, l.city as city, l.coordinate as coordinate, c.title as cat_title, c.color as cat_color' 
		);
		$query->from('`#__xcal_events` AS e');
		$query->leftJoin('`#__xcal_category` AS c ON c.id = e.catid');
		$query->leftJoin('`#__xcal_location` AS l ON l.id = e.location');
		
		// where
		$where='e.state = 1';
		if($time==0) $where.=" AND e.next >= '".$date_start."'";
	
    //if(isset($_GET['id'])) $where.=' AND e.id = '.$_GET['id'];
    //temporarily disabled this funktion with wrong name com_xcalx because there is a problem with GET-var id if for example articles are displayed
      if(isset($_GET['id']) && $_GET['option'] == "com_xcalx") {
      $eID = JRequest::getVar( "id", "", "GET", "INT");  //secure way to get variable id as int, it was given in url like "id=2:eventname&cat=2:event-categoryname" 
      //if (strpos($eID, ':')) $eID=substr($eID, 0, strpos($eID, ':'));
      $where.=' AND e.id = '.$eID;
    }
    
		if($catid!=0) $where.=' AND e.catid = '.$catid;
		if($location!='NULL') $where.=' AND e.location LIKE "%'.$location.'%"';
		$query->where($where);
		$query->order('e.next');
		$query.=' LIMIT '.$start.', '.$number;
		// eseguo la query
		$db->setQuery($query);
		$res = $db->loadObjectList();
		
		$days=$this->getDays($date_start, $format);
		//print_r($query);   //for debugging
		if ($res) foreach ($res as $r) {
			$next=$this->getNext($r->dates, $r->id);
			$datelist=$this->getDatelist($r->dates, $next);
			
			$event=array(
				'id' => $r->id,
				'url' => '?option=com_xcal&view=list&layout=event&Itemid='.$itemid.'&id='.$r->id,
				'title' => $r->title,
				'image' => $r->image,
				'dates' => $r->dataini,
				'next' => date('Y-m-d', $next),
				'time' => $r->time,
				'address' => $r->address,
				'location' => $r->location,
				'cat_title' => $r->cat_title,
				'cat_color' => $r->cat_color,
			);
			
			foreach ($datelist as $d){
				foreach ($days as $k=>$dy){
					if($d==$dy['date']){
						array_push ($days[$k]['events'], $event);
					}
				}
			}
		}
		
		
		return $days;
	}
	/***/
	 
	// ottengo l'array dei giorni del mese
	function getDays ($d, $f)
	{
				// determino mese e anno

		$ex_data=explode('-', $d);
		$mese=$ex_data[1];
		$anno=$ex_data[0];

		// genero il calendario
		$days = date("d", mktime(0, 0, 0, $mese+1, 0, $anno));
		$list = array();
		for($a=1; $a<=$days; $a++)
		{
			$list[$a]['date'] = date('Y-m-d', mktime(0, 0, 0, $mese, $a, $anno));
			$list[$a]['dateFormat'] = date($f, mktime(0, 0, 0, $mese, $a, $anno));
			$list[$a]['week'] = date('N', mktime(0, 0, 0, $mese, $a, $anno));
			$list[$a]['day'] = $a;
			$list[$a]['month'] = $mese;
			$list[$a]['year'] = $anno;
			$list[$a]['events']=array();
		}

		// genero la variabile
		return $list;
	}
	/***/
	
	/**
	 * ottengo l'elenco delle date relative ad un evento
	 */
	private function getDatelist($dates, $next)
	{
	
		$dates=unserialize($dates);
		$da=array();
		foreach($dates as $d){
			$d=$this->mkt($d);
			if($d>=$next){
				array_push($da, date('Y-m-d', $d));
			}
		}
		
		return $da;
		
	}

	private function mkt($data)
	{
		$ex_data=explode('-', $data);
		$ris=mktime('00', '00', '00', $ex_data['1'], $ex_data['2'], $ex_data['0']);
		return $ris;
	}
	
	private function addDay ($mkt) 
	{
		return $mkt+82800;
	}
	
	private function getNext ($dates, $id)
	{
		$dates=unserialize($dates);
		$today=time();
		if(count($dates)){
			$next=$this->mkt($dates[0]);
			foreach($dates as $d){
				$d=$this->mkt($d);
				if ($d>=$today){
					$next=date('Y-m-d', $d);
				}
			}
		}
		
		$db		= Jfactory::getDbo();
		$query	= $db->getQuery(true);
		
		$query->update('#__xcal_events')
			->set("`next`='".$next."'");
		$query->where('`id`='.$id);
		$db->setQuery($query);
		$db->query($query);
		
		return $next;
	}
	/***/

	/** Genero il sistema di navigazione **/
	function getNav($date_start)
	{
		$option = 'index.php?option='.JRequest::getVar('option');
		$view = '&view='.JRequest::getVar('view');
		if(JRequest::getVar('layout'))$layout = '&layout='.JRequest::getVar('layout');
		$Itemid = '&Itemid='.JRequest::getVar('Itemid');
		if(JRequest::getVar('id'))$id = '&id='.JRequest::getVar('id');
		$Aurl = $option.$view.$layout.$Itemid.$id;


		$ex_date=explode('-', $date_start);
		$mkt_date=$this->mkt($date_start);
		$year=$ex_date[0];
		$month=$ex_date[1];
		$day=1;

		if($month!=1){$backMonth=$month-1; $backYear=$year;}
		if($month==1){$backMonth=12; $backYear=$year-1;}
		if($month!=12){$nextMonth=$month+1; $nextYear=$year;}
		if($month==12){$nextMonth=1; $nextYear=$year+1;}
		$back='<a class="back xcalbtn" href="'.$Aurl.'&date='.$backYear.'-'.$backMonth.'-'.$day.'">&#9668</a>';
		$next='<a class="next xcalbtn" href="'.$Aurl.'&date='.$nextYear.'-'.$nextMonth.'-'.$day.'">&#9658</a>';
		$title=date('M', $mkt_date);

		$html.='<div class="nav">'.$back.$next.'<div class="title">'.$title.'</div></div>';

		return $html;
	}
	/***/
 
}
?>