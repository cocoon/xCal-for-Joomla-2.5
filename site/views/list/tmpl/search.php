<?php

// impedisco l'accesso diretto

defined('_JEXEC') or die('Restricted access');


if(file_exists("components/com_xcal/template/".$this->template."/".$this->template."_list.php")){ 
	$t_list = "components/com_xcal/template/".$this->template."/".$this->template."_list.php";
	$t_item = "components/com_xcal/template/".$this->template."/".$this->template."_item.php";
	JHTML::_('stylesheet', $this->template.'_style.css', 'components/com_xcal/template/'.$this->template.'/css/');

}else{
	$t_list = "components/com_xcal/template/default/default_list.php";
	$t_item = "components/com_xcal/template/default/default_item.php";
	JHTML::_('stylesheet', 'default_style.css', 'components/com_xcal/template/default/css/');
}
?>

<form id="xcalsearch" method="post">
	<input name="key" type="text" value=""/>
	<input type="submit">
</form>

<?php
if ($_POST['key']){
	$stamp = $this->data;
	require_once $t_list;
}
?>