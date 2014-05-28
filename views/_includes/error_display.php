<?php
// Error Detection and Notification
if(isset($errors) && count($errors > 0))
{
echo "\n" . '<div id="errors">'."\n";
echo "\t" . '<h3>An error has occurred!</h3>'."\n";
echo "\t" . '<ul id="error_list">'."\n";

foreach($errors as $error)
{
echo "\t\t" . '<li>' . $error . '</li>'."\n";
}

echo "\t" . '</ul>'."\n";
echo '</div>' . "\n";

}
?>