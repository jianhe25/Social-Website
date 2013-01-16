<?php
include_once 'header.php';

if (!$loggedin) die();

echo "<div class='span9'>";

if (isset($_GET['view'])) $view = sanitizeString($_GET['view']);
else                      $view = $user;

if ($view == $user)
{
    $name1 = $name2 = "你的";
    $name3 =          "你正在";
}
else
{
    $name1 = "<a href='members.php?view=$view'>$view</a>'s";
    $name2 = "$view 的";
    $name3 = "$view 是";
}

echo "<div class='main'>";

// Uncomment this line if you wish the user’s profile to show here
// showProfile($view);

$followers = array();
$following = array();

$result = queryMysql("SELECT * FROM friends WHERE user='$view'");
$num    = mysql_num_rows($result); 

for ($j = 0 ; $j < $num ; ++$j)
{
    $row           = mysql_fetch_row($result);
    $followers[$j] = $row[1];
}

$result = queryMysql("SELECT * FROM friends WHERE friend='$view'");
$num    = mysql_num_rows($result);

for ($j = 0 ; $j < $num ; ++$j)
{
    $row           = mysql_fetch_row($result);
    $following[$j] = $row[0];
}

$mutual    = array_intersect($followers, $following);
$followers = array_diff($followers, $mutual);
$following = array_diff($following, $mutual);
$friends   = FALSE;

if (sizeof($mutual))
{
    echo "<span class='subhead'>$name2 好友</span><ul>";
    foreach($mutual as $friend)
        echo "<li><a href='members.php?view=$friend'>$friend</a>";
    echo "</ul>";
    $friends = TRUE;
}

if (sizeof($followers))
{
    echo "<span class='subhead'>$name2 粉丝</span><ul>";
    foreach($followers as $friend)
        echo "<li><a href='members.php?view=$friend'>$friend</a>";
    echo "</ul>";
    $friends = TRUE;
}

if (sizeof($following))
{
    echo "<span class='subhead'>$name3 关注</span><ul>";
    foreach($following as $friend)
        echo "<li><a href='members.php?view=$friend'>$friend</a>";
    echo "</ul>";
    $friends = TRUE;
}

if (!$friends) echo "<br />你目前没有任何关注/好友<br /><br />";

echo "<a class='button' href='messages.php?view=$view'>" .
     "查看$name2 消息</a>";
?>

</div><br /></body></html>
