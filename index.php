<?php 
include_once 'header.php';
?>

<?php
echo "<br /><span class='main'>欢迎来到运动会管理系统,";

if ($loggedin) echo " $user, 你已登录.";
else           echo ' 请注册账号以便了解更多人';

?>

</span><br /><br /></body></html>
