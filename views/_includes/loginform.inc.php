<?php
include_once (ABSOLUTE_PATH.'/models/user.model.php');
if (isset($_SESSION['user_id'])){
	
	$user = new User();
	$result = $user->get_user($_SESSION['user_id']);
    foreach ($result as $row)
    {
        $_SESSION['first_name'] = $row['first_name'];
		$_SESSION['last_name'] = $row['last_name'];
	
	echo 'Signed in as: <strong>'.$_SESSION['first_name'] .' '. $_SESSION['last_name'].'</strong><br />'; }
	echo '<a href="'.(constant("URL_ROOT").'logout/index.php').'">Log Out</a>';
} else {
	echo $login_form = '<form id="login" method="post" action="'. (constant("URL_ROOT").'authenticate/').'">

<label for="email">E-mail Address:</label>
<input type="text" id="email" name="email" maxlength="20" tabindex="1" />
        
<label for="password">Password:</label>
<input type="password" id="password" name="password" maxlength="20" tabindex="2" />
        
<input type="submit" id="login_submit" name="login_submit" value="Login" />
<a href="'.(constant("URL_ROOT").'registration/').'" title="Register Today" id="register_link">Register Today!</a>
</form>';
}
?>