<?php
// impedisco l'accesso diretto
defined('_JEXEC') or die('Restricted access');

// importo le librerie di Joomla relative ai models
jimport('joomla.application.component.modelitem');

class XModelItem extends JModelItem 
{
	/**
	 * @var msg
	 */
	protected $msg;
	protected $filters;
	protected $options;
	protected $itObj;
	protected $where;

	/**
	 * Costruttore
	 */
	protected function startXModel() 
	{
        $this->filters = array();
        $this->options = array();
        $this->items = array();
        $itObj= new stdClass;
    }

	/**
	 * Imposto la table
	 */
	public function getTable($type = 'xcal', $prefix = 'xcalTable', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * ottengo tutti i dati
	 */
	protected function getItems ($structure)
	{
		// conteggio degli items
		$this->items=$this->getDBitems();
		 
		foreach ($structure as $k=>$v)
		{
			$this->itObj->$k=$this->$k($v);
		}
		return $this->itObj;
	}

	/**
	 * Aggiungo i filtri che verranno utilizzati nelle query
	 */
	protected function addFilter($name, $value)
	{
		$this->filters[$name]=$value;
	}

	/**
	 * Aggiungo le opzioni che utilizzeremo per ottenere i vari dati nel giusto settaggio
	 */
	protected function addOption($name, $value)
	{
		$this->options[$name]=$value;
	}

	/**
	 * Finalmente prelevo i dati dal DB
	 */
	protected function getDBitems()
	{
		// preparo la connessione al db
		$db	= $this->getDbo();


		// preparo la query
		$query = $db->getQuery(true);

		// voci da selezionare
		$query->select('e.id, e.title, e.alias, e.params, e.catid, e.image, e.file, e.dates, e.time, e.desc, e.next');
		$query->select(' l.address as address, l.name as location_name, l.city as city, l.coordinate as coordinate, l.desc as location_desc');
		$query->select(' c.title as cat_title, c.color as cat_color, c.desc as cat_desc, c.alias as cat_alias');
		$query->select(' r.id as regisId');
		// join
		$query->from('`#__xcal_events` AS e');
		$query->leftJoin('`#__xcal_category` AS c ON c.id = e.catid');
		$query->leftJoin('`#__xcal_location` AS l ON l.id = e.location');
		$query->leftJoin('`#__xcal_registration` AS r ON r.eventid = e.id');
		// were (filtri)
		$filters=$this->filters;
		$where='e.state ='.$filters['state'];
		unset($filters['state']);
		foreach($filters as $k=>$v){
			// casi normali
			if ($k!='key' && $k!='next' && $k!='e.catid' && $k!='id'){
				$where.=' AND '.$k.' LIKE "%'.$v.'%"';
			}
			// in caso di ricerca
			if ($k=='key'){
				$keys=explode(' ', $v);
				foreach ($keys as $ke){
					$where.=' AND (e.title LIKE \'%'.$ke.'%\' OR ';
					$where.=' e.desc LIKE \'%'.$ke.'%\' OR ';
					$where.=' l.address LIKE \'%'.$ke.'%\' OR ';
					$where.=' e.location LIKE \'%'.$ke.'%\' OR ';
					$where.=' c.title LIKE \'%'.$ke.'%\')';
				}
			}
			// il caso del TEMPO :|
			if ($k=='next'){
				if($v==1) $where.=' AND e.next >= (CURDATE())';
				if($v==2) $where.=' AND e.next <= (CURDATE())';
			}
			// in caso della categoria
			if ($k=='e.catid'){
				$where.=' AND '.$k.'='.$v;
			}
			// in caso di id
			if ($k=='id'){
				$where.=' AND e.id='.$v;
			}
		}
		$this->where=$where;
		$query->where($where);
		// ordino e limito la query
		$query->order('e.next');
		if (!$_GET['page']){
			$start='0';
		}else{
			$start = $this->options['number']*($_GET['page']-1);
		}
		$query.=' LIMIT '.$start.', '.$this->options['number'];
		$db->setQuery($query);
		return $db->loadObjectList();
	}

	// *** INIZIA ORA UNA SERIE DI FUNZIONI DEDICATE A OTTENERE TUTTI I VALORI NECESSARI A RIEMPIRE L'OGGETTO *** //

	// *** CONTAINER *** //
	protected function container ($atr){
		$contDef=new stdClass;
		foreach ($atr as $k=>$v){
			$contDef->$k=$this->$k();
		}
		return $contDef;
	}
	protected function template ()
	{
		return $this->options['template'];
	}

	protected function navigator ()
	{
		// dichiaro i controlli
		$ctrlNext=NULL;
		$ctrlBack=NULL;

		// verifico se vi sono altri eventi dopo quelli selezionati
		$db	= $this->getDbo();
		$query = $db->getQuery(true);
		$query->select('count(e.id) AS max')->from('#__xcal_events AS e');
		$filters=$this->filters;
		$where='e.state ='.$filters['state'];
		unset($filters['state']);
		foreach($filters as $k=>$v){
			// casi normali
			if ($k!='key' && $k!='next' && $k!='e.catid' && $k!='id'){
				$where.=' AND '.$k.' LIKE "%'.$v.'%"';
			}
			// il caso del TEMPO :|
			if ($k=='next'){
				if($v==1) $where.=' AND e.next >= (CURDATE())';
				if($v==2) $where.=' AND e.next <= (CURDATE())';
			}
			// in caso della categoria
			if ($k=='e.catid'){
				$where.=' AND '.$k.'='.$v;
			}
		}
		if (!$_GET['page']){
			$start='0';
		}else{
			$start = $this->options['number']*($_GET['page']-1);
		}
		$query.=' LIMIT '.$start.', '.($this->options['number']+1);
		$db->setQuery($query);
		$max=$db->loadObject()->max;
		if ($max > $this->options['number'])$ctrlNext=1;

		// verifico se vi sono elementi prima di quelli selezionati
		if($_GET['page'] && $_GET['page']>1)$ctrlBack=1;

		// genero il navigatore
		$nav='<div class="Xnavigator">';
		//get current URL
		$navurl =& JURI::getInstance();

		if ($ctrlBack!=NULL){
			$pageBack=$_GET['page']-1;
			//$nav.='<a class="xcal_back" href="'.JRoute::_(JURI::current().'?page='.$pageBack).'">&#9668</a>';
			$navurl->setVar( 'page', $pageBack );
			$nav.='<a class="xcal_back" href="'.$navurl->toString().'">&#9668</a>';
      			$nav.=' '.JText::_('COM_XCAL_GENERAL_BACKWARDS').' ';
		}
		if ($ctrlBack!=NULL || $ctrlNext!=NULL) $nav.="<b>".JText::_('COM_XCAL_GENERAL_PAGE')."</b>";
		if ($ctrlNext!=NULL){
			if(!$_GET['page']){$pageNext=2;}else{$pageNext=$_GET['page']+1;}
			//$nav.='<a class="xcal_back" href="'.JRoute::_(JURI::current().'?page='.$pageNext).'">&#9658</a>';
			$navurl->setVar( 'page', $pageNext );
			$nav.=' '.JText::_('COM_XCAL_GENERAL_FORWARDS').' ';
      			$nav.='<a class="xcal_next" href="'.$navurl->toString().'">&#9658</a>';
		}
		$nav.='</div>';
		return $nav;
	}


	// *** ITEMS *** //
	protected function items ($atr){
		$atr=$atr['item'];
		$items=$this->items;
		//print_r($this); 
    $itDef=new stdClass;
		if ($items) foreach($items as $i){
			$i=$this->ctrlNext($i);
			$it=new stdClass;
			$id=$i->id;
			foreach($atr as $k=>$v){
				if($i->$k!=NULL){
					$it->$k=$i->$k;
				}else{
					if(method_exists($this, $k)){$it->$k=$this->$k($i);}
				}
			}
			$itDef->$id=$it;
		}
		return $itDef;
	}

	protected function url ($i){
		return JRoute::_('index.php?option=com_xcal&view=list&layout=event&Itemid='.$this->options['Itemid'].'&id='.$i->id.':'.$i->alias.'&cat='.$i->catid.':'.$i->cat_alias);
	}

	protected function titleLink ($i){
		$title=$i->title;
		$url=$this->url($i);
		return '<a href="'.$url.'">'.$title.'</a>';
	}

	protected function descShort ($i){
		$limit=$this->options['limit'];
		$text=preg_replace('/<img[^>]*>/Ui', '', $i->desc);
		$text=str_replace('<br>', '', $text);
		$text=str_replace('<p></p>', '', $text);
		if(strlen($text)>$limit){
			$stringa_tagliata=substr($text, 0,$limit);
			$last_space=strrpos($stringa_tagliata," ");
			$stringa_ok=substr($stringa_tagliata, 0,$last_space);
			$text=$stringa_ok." ";
		}else{
			$text=$text;
		}
		return $text;
	}

	protected function imageTag ($i){
		return '<img src="'.$i->image.'"/>';
	}

	protected function fileTag ($i){
		return '<a class="xDownload" href="'.$i->file.'">Download</a>';
	}

	protected function nextMkt ($i){
		return $this->mkt($i->next);
	}

	protected function nextDate ($i){
		return $this->formatDate($this->mkt($i->next));
	}

	protected function day ($i){
		return date('d', $this->mkt($i->next));
	}

	protected function month ($i){
		return date('m', $this->mkt($i->next));
	}

	protected function monthTxt ($i){
		return $this->formatDate($this->mkt($i->next), 'F');
	}

	protected function monthShort ($i){
		return $this->formatDate($this->mkt($i->next), 'M');
	}

	protected function year ($i){
		return date('Y', $this->mkt($i->next));
	}

	protected function yearShort ($i){
		return date('y', $this->mkt($i->next));
	}

	protected function datelist ($i){
		return unserialize($i->dates);
	}

	protected function datelistMkt ($i){
		$days=unserialize($i->dates);
		foreach ($days as $k=>$d){
			$days[$k]=$this->mkt($d);
		}
		return $days;
	}

	protected function datelistUl ($i){
		$days=unserialize($i->dates);
		$daysUl='<ul class="xDates">';
		foreach ($days as $k=>$d){
			$d=$this->formatDate2($d);
			$daysUl.='<li>'.$d.'</li>';
		}
		$daysUl.='</ul>';
		return $daysUl;
	}

	protected function formatDate ($d, $for=NULL){
		if($for==NULL)$for=$this->options['format'];
		$exformat = explode ('-', $for);
		foreach($exformat as $k=>$val){
			switch($val){
				// day
				case 'd': $val='%d'; break;
				case 'D': $val='%a'; break;
				case 'j': $val='%e'; break;
				case 'l': $val='%A'; break;
				case 'N': $val='%u'; break;
				case 'w': $val='%w'; break;
				case 'z': $val='%j'; break;

				// week
				case 'W': $val='%W'; break;

				// month
				case 'F': $val='%B'; break;
				case 'm': $val='%m'; break;
				case 'M': $val='%b'; break;
				case 'n': $val='%m'; break;

				// year
				case 'Y': $val='%Y'; break;
				case 'y': $val='%g'; break;

				default: $val=''; break;		
			}
			if($k!=0)$format.='-'.$val;
			if($k==0)$format.=$val;
		}
		setlocale(LC_TIME, JText::_( 'XCAL_WIN_SERVER_LANG' ), JText::_( 'XCAL_LINUX_SERVER_LANG' ));
		return strftime($format, $d);
	}

	protected function formatDate2 ($d, $for=NULL){
		if($for==NULL)$for=$this->options['format'];
		$exformat = explode ('-', $for);
		foreach($exformat as $k=>$val){
			switch($val){
				// day
				case 'd': $val='%d'; break;
				case 'D': $val='%a'; break;
				case 'j': $val='%e'; break;
				case 'l': $val='%A'; break;
				case 'N': $val='%u'; break;
				case 'w': $val='%w'; break;
				case 'z': $val='%j'; break;

				// week
				case 'W': $val='%W'; break;

				// month
				case 'F': $val='%B'; break;
				case 'm': $val='%m'; break;
				case 'M': $val='%b'; break;
				case 'n': $val='%m'; break;

				// year
				case 'Y': $val='%Y'; break;
				case 'y': $val='%g'; break;

				default: $val=''; break;		
			}
			if($k!=0)$format.='-'.$val;
			if($k==0)$format.=$val;
		}
		setlocale(LC_TIME, JText::_( 'XCAL_WIN_SERVER_LANG' ), JText::_( 'XCAL_LINUX_SERVER_LANG' ));
		return strftime($format, strtotime($d));
	}

	protected function lat ($i){
		$ex=explode(', ', $i->coordinate);
		return $ex[0];
	}

	protected function lng ($i){
		$ex=explode(', ', $i->coordinate);
		return $ex[1];
	}

	protected function map ($i){
		return '<script>jQuery(document).ready(function() { initialize('.$this->lat($i).', '.$this->lng($i).', '.$i->id.'); });</script><div class="xcal_map" id="map_canvas'.$i->id.'" style="width:'.$this->options['m_width'].'; height:'.$this->options['m_height'].'"></div>';
	}

	protected function share ($i){
		$text='<!-- AddThis Button BEGIN -->';
		$text.='<div class="xcal-social addthis_toolbox addthis_default_style addthis_16x16_style"';
		$text.='addthis:url="'.$this->url($i);
		$text.='" addthis:title="'.$i->title.'">';
		$text.='<a class="addthis_button_google_plusone"></a>';
		$text.='<a class="addthis_button_facebook"></a>';
		$text.='<a class="addthis_button_twitter"></a>';
		$text.='<a class="addthis_counter addthis_bubble_style"></a>';
		$text.='</div><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4dbac3f233e1e124"></script>';
		$text.='<!-- AddThis Button END -->';
		return $text;
	}

	protected function gcalendarUrl ($i){
		$ora=$i->time;
		if($ora==0)$ora='00.00';
		$text=$i->title.' ('.$i->cat_title.')';
		$details=$this->descShort($i);
		$location=$i->location.', '.$i->address;
		$link=$this->url($i);

		$dates=str_replace('-', '', $date).'T'.str_replace('.', '', $ora).'00/'.str_replace('-', '', $date).'T'.str_replace('.', '', $ora).'00';
		$href="http://www.google.com/calendar/event?action=TEMPLATE
			&text=".urlencode($text)."
			&dates=".$dates."
			&location=".urlencode($location)."
			&details=".urlencode($details)."
			&sprop=sito web:".urlencode($link);
		
		return $href;
	}

	protected function gcalendarLink ($i){
		return '<a href="'.$this->gcalendarUrl($i).'">Gcalendar</a>';
	}

	protected function regUrl ($i){
		return JROUTE::_('index.php?option=com_xcal&view=list&layout=registration&Itemid='.$this->options['Itemid'].'&id='.$i->id.':'.$i->alias.'&cat='.$i->catid.':'.$i->cat_alias);
	}

	protected function reg ($i){
		return '<a class="regis_button" href="'.$this->regUrl($i).'" alt="'.JText::_("XCAL_REGISTRATION_DESC").'">'.JText::_( 'XCAL_REGISTRATION' ).'</a>';
	}

	protected function registered ($i){
		return count($i->regisId);
	}


	/** FUNZIONE CHE CONTROLLA SE SPOSTARE NEXT **/
	protected function ctrlNext ($i){
		$toDay=time();
		$nextMkt=$this->mkt($i->next);
		$exora=explode(':', $i->time);
		$h=date(h);
		$m=date(i);

		if ($next>$toDay){
			$ctrl=0;
		}elseif($next==$toDay){
			if($exora[0]>$h){
				$ctrl=0;
			}elseif($exora[1]>$m){
				$ctrl=0;
			}else{
				$ctrl=1;
			}
		}else{
			$ctrl=1;
		}

		if($ctrl==0){
			return $i;
		}else{
			$days=unserialize($i->dates);
			foreach($days as $d){
				$dMkt=$this->mkt($d);
				if ($dMkt>$toDay){
					$i->next=$d;
					return $i;
				}
			}
			$this->writeNext($i);
			return $i;
		}

	}

	// *** FUNZIONI INDISPENSABILI *** //
	private function mkt($data)
	{
		$ex_data=explode('-', $data);
		$ris=mktime('00', '00', '00', $ex_data['1'], $ex_data['2'], $ex_data['0']);
		return $ris;
	}

	private function writeNext($i){
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);
		
		$query->update('#__xcal_events')
			->set("`next`='".$i->next."'");
		$query->where('`id`='.$i->id);
		$db->setQuery($query);
		$db->query($query);
	}

}
?>
