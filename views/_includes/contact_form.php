<?php
include(ABSOLUTE_PATH . '/views/_includes/error_display.php');
?>

<form id="contact_form" action="<?=$PHP_SELF?>" method="post">

<fieldset>
<legend>Contact Information</legend>
<label for="first_name">First Name: <?=REQFIELD?></label>
<input type="text" id="first_name" name="first_name" value="<?=$first_name?>" maxlength="20" />
            
<label for="last_name">Last Name: <?=REQFIELD?></label>
<input type="text" class="txt" id="last_name" name="last_name" value="<?=$last_name?>" maxlength="20" />
 
<label for="email">E-mail Address: <?=REQFIELD?></label>
<input type="text" class="txt" id="email" name="email" value="<?=$email?>" maxlength="100" />

<br />
<br />          
<label for="area_code">Phone Number: <?=REQFIELD?></label>
<input type="text" class="txt" id="area_code" name="area_code" value="<?=$area_code?>" maxlength="3" />
&ndash;
<input type="text" class="txt" id="ph_pref" name="ph_pref" value="<?=$ph_pref?>" maxlength="3" />
&ndash;
<input type="text" class="txt" id="ph_suff" name="ph_suff" value="<?=$ph_suff?>" maxlength="4" />
</fieldset>
<br />
<fieldset>
<legend>Message</legend>
<label for="message">Message: <?=REQFIELD?></label><br />
<textarea rows="4" cols="75" id="message" name="message" placeholder="Please enter your message."><?=$message?></textarea>
<br />
<br />
 
<input type="submit" id="submit" name="submit" value="Submit">  
</fieldset>
</form>