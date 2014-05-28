<?php
include(ABSOLUTE_PATH.'/views/_includes/error_display.php');
?>

<form id="profile_form" action="<?=$PHP_SELF?>" method="post">

<fieldset>
<legend>Profile Information</legend>
<label for="first_name">First Name: <?=REQFIELD?></label>
<input type="text" class="txt" id="first_name" name="first_name" value="<?=$first_name?>" maxlength="20" />
            
<label for="last_name">Last Name: <?=REQFIELD?></label>
<input type="text" class="txt" id="last_name" name="last_name" value="<?=$last_name?>" maxlength="20" />
 
<label for="email">E-mail Address: <?=REQFIELD?></label>
<input type="text" class="txt" id="email" name="email" value="<?=$email?>" maxlength="100" />

<br />
<br />          
<label for="password">Password: <?=REQFIELD?></label>
<input type="password" class="txt" id="password" name="password" maxlength="20" tabindex="6" value="">

<label for="password2">Confirm Password: <?=REQFIELD?></label>
<input type="password" class="txt" id="password2" name="password2" maxlength="20" tabindex="7" value="">
<br />
<br />
 
<input type="submit" id="profile_submit" name="profile_submit" tabindex="8" value="Update Profile">  
</fieldset>
</form>