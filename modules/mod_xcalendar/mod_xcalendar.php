<?php
// impediamo l'accesso diretto alla pagina
defined('_JEXEC') or die;
// chiamata al file helper.php
require_once dirname(__FILE__).DS.'helper.php';
// chiamata al modulo
$cal=new modXcalendarHelper;
$data = $cal->getStamp($params);

$date_start=date('Y-m-d');
if($_GET['date']) $date_start=$_GET['date'];
$nav=$cal->getNav($date_start);

$params->get('numero');
$template=$params->get('template');

if(!file_exists("components/com_xcal/template/".$template."/".$template."_calendar.php")){
$template='default';
}

$t_calendar = "components/com_xcal/template/".$template."/".$template."_calendar.php";
$t_day = "components/com_xcal/template/".$template."/".$template."_day.php";
JHTML::_('stylesheet', $template.'_style.css', 'components/com_xcal/template/'.$template.'/css/');
if(file_exists("components/com_xcal/template/".$template."/js/".$template."_function.js")){
	JHTML::script('jquery.min.js', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/');
	JHTML::script("components/com_xcal/template/".$template."/js/".$template."_function.js");
}

JHTML::script("modules/mod_xcalendar/js/function.js");

$stamp = new cal($data, $t_day, $nav);
require_once $t_calendar;

class cal
{

	public $data;
	public $t_day;
	public $nav;

	function __construct ($data, $t_day, $nav)
	{
		$this->data=$data;
		$this->t_day=$t_day;
		$this->nav=$nav;
	}

	function days ()
	{
		echo '<div id="mod_xcalendar">'.$this->nav.'
			<table id="xcal_calendar" width="100%">
				<thead>
					<th width="15%">'.JText::_('MOD_XCALENDAR_DAY_01').'</th>
					<th width="14%">'.JText::_('MOD_XCALENDAR_DAY_02').'</th>
					<th width="14%">'.JText::_('MOD_XCALENDAR_DAY_03').'</th>
					<th width="14%">'.JText::_('MOD_XCALENDAR_DAY_04').'</th>
					<th width="14%">'.JText::_('MOD_XCALENDAR_DAY_05').'</th>
					<th width="14%">'.JText::_('MOD_XCALENDAR_DAY_06').'</th>
					<th width="15%">'.JText::_('MOD_XCALENDAR_DAY_07').'</th>
				</thead>
		';
		
		switch ($this->data[1][week]){
			case 1:
				break;
			default:
				echo '<tr><td colspan="'.($this->data[1][week]-1).'"></td>';
				break;		
		}
		
		foreach ($this->data as $d){
			$stamp= new day($d);
			
			switch($stamp->week){
				case 1:
					echo '<tr><td>';
					break;
				default:
					echo '<td>';
					break;
			}
			
			require $this->t_day;
			
			switch($week){
				case 7:
					echo '</td></tr>';
					break;
				default:
					echo '</td>';
					break;
			}
		}
		
		switch ($stamp->week){
			case 7:
				break;
			default:
				echo '<td colspan="'.(7-$stamp->week).'"></td></tr>';
				break;		
		}
		
		echo '</table></div>';
	}

}

class day
{
	public $date;
	public $week;
	public $day;
	public $month;
	public $year;
	public $events;
	
	function __construct ($day)
	{
		foreach ($day as $k=>$v){
			$this->$k=$v;
		}
	}
}
//require JModuleHelper::getLayoutPath('mod_xcalendar');
