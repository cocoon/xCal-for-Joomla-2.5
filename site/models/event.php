<?php
// impedisco l'accesso diretto
defined('_JEXEC') or die('Restricted access');
 
// importo le librerie di Joomla relative ai models
jimport('joomla.application.component.modelitem');
 
/**
 * xcal elenco Model
 */
jimport( 'joomla.form.form' );

class xcalModelEvent extends JModelItem
{
	/**
	 * @var msg
	 */
	protected $msg;

	function getForm() 
	{
	    $form=&JForm::getInstance('event', JPATH_COMPONENT.DS.'models'.DS.'forms'.DS.'event.xml');
	    return $form;
	}

	function getDb()
	{
		$data =new stdClass();
		$data->id = null;
		$data->ordering=0;
		$data->checked_out = $_POST['uid'];
		$data->checked_out_time=date('Y-m-d H:i:s');
		$data->state=1;
		$data->title = $_POST['title'];
		$data->username = $_POST['username'];
		$data->email = $_POST['email'];
		$data->catid = $_POST['catid'];
		$data->location = $_POST['location'];
		$data->image = $this->upload('image');
		$data->file = $this->upload('file');
		
		if($_POST['dates']){
			$datesAr=$this->getDates($_POST['dates']);
			$data->dates = serialize($datesAr);
			$data->next = $this->getNext($data->dates);
		}

		$data->ora = $_POST['ora'];

		$data->luogo = $_POST['luogo'];
		$data->coordinate = $_POST['coordinate'];

		$data->desc = $_POST['desc'];
		
		$db	= $this->getDbo();
		$db->insertObject('#__xcal_events', $data, id);
	}

	function getDates ($dates)
	{
		$dates=str_replace('d=', '', $dates);
		$ex_dates=explode('&', $dates);
		return $ex_dates;
	}

	function getNext ($dates)
	{
		$dates=unserialize($dates);
		$today=time();
		if(count($dates)){
			$next=$dates[0];
			if ($this->mkt($next)<$today){
				foreach($dates as $d){
					$MktD=$this->mkt($d);
					if ($MktD>=$today){
						$next=$d;
					}
				}
			}
			return $next;
		}
	}

	function upload ($field){
		$filename = JFile::makeSafe($_FILES[$field]['name']);

		if($filename!=''){

			$src = $_FILES[$field]['tmp_name'];
			$ddest= JPATH_SITE. DS ."images".DS."xcal_doc";
			$dest =  $ddest.DS.$filename;
			
			if(!is_dir($ddest)){
				mkdir($intDir, 0777);
			}


			if ( JFile::upload($src, $dest, false) ){
				return 'images/xcal_doc/'.$filename;
			}
			
			return 'images/xcal_doc/'.$filename;
		}
	}

	function mkt($data)
	{
		$ex_data=explode('-', $data);
		$ris=mktime('00', '00', '00', $ex_data['1'], $ex_data['2'], $ex_data['0']);
		return $ris;
	}

}