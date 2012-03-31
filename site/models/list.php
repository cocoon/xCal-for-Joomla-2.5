<?php
// impedisco l'accesso diretto
defined('_JEXEC') or die('Restricted access');
 
jimport( 'joomla.filesystem.path' );

if(!class_exists('XModelItem'))require(JPATH_COMPONENT.DS.'helpers'.DS.'xmodel.php');
 
/**
 * xcal elenco Model
 */
class xcalModelList extends XModelItem
{

	/**
	 * Ottengo idati
	 * @restituisco i dati
	 */
	public function getData() 	
	{
		$this->startXModel();
		$user =& JFactory::getUser();
		$userid=$user->get('id');
		
		if ($_POST['event']){
			$this->registration();
		}
	
		// importo le opzioni
		$app = JFactory::getApplication();
		$xpar = $app->getParams();

		// filtri
		$this->addFilter('state', 1);
		if($xpar->get('mcatid')) $this->addFilter('e.catid', $xpar->get('mcatid'));
		if($xpar->get('location')!='NULL') $this->addFilter('e.location', $xpar->get('location'));
		if($xpar->get('address')) $this->addFilter('l.address', $xpar->get('address'));
		if($_POST['key']) $this->addFilter('key', $_POST['key']);
		if($xpar->get('time')) $this->addFilter('next', $xpar->get('time'));
		if($_GET['id']){
			$exId=explode(':', $_GET['id']);
			$this->addFilter('id', $exId[0]);
		} 

		// opzioni
		if($xpar->get('number')) $this->addOption('number', $xpar->get('number'));
		if($xpar->get('template')) $this->addOption('template', $xpar->get('template'));
		if($xpar->get('limit')) $this->addOption('limit', $xpar->get('limit'));
		if($xpar->get('format')) $this->addOption('format', $xpar->get('format'));
		if($xpar->get('m_width')) $this->addOption('m_width', $xpar->get('m_width'));
		if($xpar->get('m_height')) $this->addOption('m_height', $xpar->get('m_height'));
		if($xpar->get('itemid')) {$this->addOption('Itemid', $xpar->get('itemid'));} else {$this->addOption('Itemid', $_GET['Itemid']);}

		// struttura
		$structure=array(
			'container'=>array(
				'template'=>'',
				'navigator'=>''
			),
			'items'=>array(
				'item'=>array(
					'id'=>'',
					'title'=>'',
					'url'=>'',
					'titleLink'=>'',
					'cat_title'=>'',
					'cat_color'=>'',
					'cat_desc'=>'',

					'desc'=>'',
					'descShort'=>'',

					'image'=>'',
					'imageTag'=>'',
					'file'=>'',
					'fileTag'=>'',

					'nextMkt'=>'',
					'next'=>'',
					'nextDate'=>'',
					'day'=>'',
					'month'=>'',
					'monthTxt'=>'',
					'monthShort'=>'',
					'year'=>'',
					'yearShort'=>'',
					'datelistMkt'=>'',
					'datelist'=>'',
					'datelistUl'=>'',
					'ora'=>'',

					'address'=>'',
					'location_name'=>'',
					'location_desc'=>'',
					'city'=>'',
					'coordinate'=>'',
					'lat'=>'',
					'lng'=>'',
					'map'=>'',

					'share'=>'',
					'gcalendarUrl'=>'',
					'gcalendarLink'=>'',

					'registered'=>'',
					'reg'=>'',
					'regUrl'=>''
				)
			)
		);

		return $this->getItems($structure);
	}

}