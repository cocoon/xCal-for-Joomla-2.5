<?php

// impedisco l'accesso diretto

defined('_JEXEC') or die('Restricted access');


if(file_exists("components/com_xcal/template/".$this->template."/".$this->template."_list.php")){ 
	$t_list = "components/com_xcal/template/".$this->template."/".$this->template."_list.php";
	JHTML::_('stylesheet', $this->template.'_style.css', 'components/com_xcal/template/'.$this->template.'/css/');

}else{
	$t_list = "components/com_xcal/template/default/default_list.php";
	JHTML::_('stylesheet', 'default_style.css', 'components/com_xcal/template/default/css/');
}
$stamp = $this->data;

require_once $t_list;

?>