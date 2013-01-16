<?php 
include_once 'header.php';

if (!$loggedin) die();


if (isset($_GET['view']))
{
    $view = sanitizeString($_GET['view']);
    
    if ($view == $user) $name = "你的";
    else                $name = "$view"."的";
    
    echo "<h3>$name 首页</h3>";
    showProfile($view);
	 echo "<a class='button' href='messages.php?view=$view'>" .
         "查看$name 消息</a><br /><br />";
    die("</div></body></html>");
}

if (isset($_GET['add']))
{
    $add = sanitizeString($_GET['add']);
    if (mysql_num_rows(queryMysql("SELECT * FROM members 
        WHERE user = '$add'")))
        if (!mysql_num_rows(queryMysql("SELECT * FROM friends
            WHERE user='$add' AND friend='$user'")))
            queryMysql("INSERT INTO friends VALUES ('$add', '$user')");
}
elseif (isset($_GET['remove']))
{
    $remove = sanitizeString($_GET['remove']);
    queryMysql("DELETE FROM friends WHERE user='$remove' AND friend='$user'");
}

$result = queryMysql("SELECT user FROM members ORDER BY user");
$num    = mysql_num_rows($result);

echo "<h3>其他运动员</h3><ul>";

for ($j = 0 ; $j < $num ; ++$j)
{
    $row = mysql_fetch_row($result);
    if ($row[0] == $user) continue;
    
    echo "<li><a href='members.php?view=$row[0]'>$row[0]</a>";
    $follow = "关注";

    $t1 = mysql_num_rows(queryMysql("SELECT * FROM friends
        WHERE user='$row[0]' AND friend='$user'"));
    $t2 = mysql_num_rows(queryMysql("SELECT * FROM friends
        WHERE user='$user' AND friend='$row[0]'"));

    if (($t1 + $t2) > 1) echo " &harr; 你的好友";
    elseif ($t1)         echo " &larr; 你的关注";
    elseif ($t2)       { echo " &rarr; 正在关注你";
	                      $follow = "接受"; }
    
    if (!$t1) echo " [<a href='members.php?add=".$row[0]    . "'>$follow</a>]";
    else      echo " [<a href='members.php?remove=".$row[0] . "'>取消关注</a>]";
}
?>

<br /></div></body></html>
