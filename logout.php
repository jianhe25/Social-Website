<?php
include_once 'header.php';

if (isset($_SESSION['user']))
{
    destroySession();
    echo "<div class='main'>你已经登出，请点击" .
         "<a href='index.php'>这里</a>更新页面";
}
else echo "<div class='main'><br />" .
          "你不能登出，因为你还没登入";
?>

<br /><br /></div></body></html>
