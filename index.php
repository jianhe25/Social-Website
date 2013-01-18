<?php 
include_once 'header.php';
?>

<?php
echo "<br /><span class='main'>Welcome to connect you,";

if ($loggedin) echo " $user, you have already logged in.";
else           echo ' sign up to meet your friends!';

?>

</div></body></html>
