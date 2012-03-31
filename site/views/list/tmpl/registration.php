<?php

// impedisco l'accesso diretto

defined('_JEXEC') or die('Restricted access');

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

$stamp = $this->data;
require_once $t_list;

$user =& JFactory::getUser();
$u_id=$user->get('id');
$u_mail=$user->get('email');
$u_name=$user->get('name');

?>

<div class="xcal">
	<form name="registration" class="xcal_form" method="post">
	<div class="fieldset">
		<ul>
			<li>
				<label><?php echo JText::_( 'XCAL_REGISTRATION_FORM_USERID' ); ?></label>
				<?php if ($u_id){
					echo '<input type="text" value="'.$u_id.'" disabled="disabled" size="2" />
						  <input type="hidden" name="uid" value="'.$u_id.'" />';
				}else{
					echo '<input type="text" name="uid" value="" disabled="disabled" size="2" />';
				}?>
				<span class="formInfo" ><?php echo JText::_( 'XCAL_REGISTRATION_FORM_USERID_DESC' ); ?></span>
			</li>
			<li>
				<label><?php echo JText::_( 'XCAL_REGISTRATION_FORM_NAME' ); ?></label>
				<?php if ($u_mail){
					echo '<input type="text" value="'.$u_name.'" disabled="disabled" />
						  <input type="hidden" name="name" value="'.$u_name.'" />';
				}else{
					echo '<input type="text" name="name" value="" />';
				}?>
				<span class="formInfo" ><?php echo JText::_( 'XCAL_REGISTRATION_FORM_NAME_DESC' ); ?></span>
			</li>
			<li>
				<label><?php echo JText::_( 'XCAL_REGISTRATION_FORM_EMAIL' ); ?></label>
				<?php if ($u_name){
					echo '<input type="text" value="'.$u_mail.'" disabled="disabled" />
						  <input type="hidden" name="email" value="'.$u_mail.'" />';
				}else{
					echo '<input type="text" name="email" value="" />';
				}?>
				<span class="formInfo" ><?php echo JText::_( 'XCAL_REGISTRATION_FORM_EMAIL_DESC' ); ?></span>
			</li>
			<li>
				<label><?php echo JText::_( 'XCAL_REGISTRATION_FORM_PHONE' ); ?></label>
				<input type="text" name="phone" />
				<span class="formInfo" ><?php echo JText::_( 'XCAL_REGISTRATION_FORM_PHONE_DESC' ); ?></span>
			</li>
			<li>
				<label><?php echo JText::_( 'XCAL_REGISTRATION_FORM_DATE' ); ?></label>
				<select type="hidden" name="date">
					<?php
					foreach($stamp->items as $item){
						foreach($item->datelistMkt as $date){
							echo '<option value="'.$date.'">'.date($this->format, $date).'</option>';
						}
					}
					?>
				<select>
				<span class="formInfo" ><?php echo JText::_( 'XCAL_REGISTRATION_FORM_DATE_DESC' ); ?></span>
			</li>
			<li>
				<label><?php echo JText::_( 'XCAL_REGISTRATION_FORM_PEOPLE' ); ?></label>
				<input type="text" name="people" maxlength="2" size="2" />
				<span class="formInfo" ><?php echo JText::_( 'XCAL_REGISTRATION_FORM_PEOPLE_DESC' ); ?></span>
			</li>
			<li>
				<input type="hidden" name="event" value="<?php echo $_GET['id']; ?>" />
			</li>
			<li>
				<input type="submit" value="<?php echo JText::_( 'XCAL_REGISTRATION_FORM_SUBMIT' ); ?>" class="button" name="Submit"/>
			</li>
		</ul>
	</div>
	</form>
</div>