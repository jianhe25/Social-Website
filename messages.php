<?php 
include_once 'header.php';

if (!$loggedin) die();

echo "<div class='span9'>";
 
if (isset($_GET['view'])) {
    $view = sanitizeString($_GET['view']);
    $result = queryMysql("SELECT * FROM members WHERE user = '$view'");
    if (!mysql_num_rows($result)) {
        echo "<br /><span class='info'>你查看的页面不存在</span><br /><br />";
        die();
    }
} else                      
    $view = $user;

if (isset($_POST['text']))
{
    $text = sanitizeString($_POST['text']);

    if ($text != "")
    {
        $pm   = substr(sanitizeString($_POST['pm']),0,1);
        $time = time();
        queryMysql("INSERT INTO messages VALUES(NULL, '$user',
            '$view', '$pm', $time, '$text')");
    }
}

if ($view != "")
{
    if ($view == $user) $name1 = $name2 = "你的";
    else
    {
        $name1 = "<a href='members.php?view=$view'>$view</a>的";
        $name2 = "$view"."的";
    }

    echo "<div class='main'><h3>$name1" . "消息</h3>";
    showProfile($view);
    
    echo <<<_END
<form method='post' action='messages.php?view=$view'>
留言板：<br />
<textarea name='text' cols='40' rows='3'></textarea><br />
公共<input type='radio' name='pm' value='0' checked='checked' />
悄悄话<input type='radio' name='pm' value='1' />
<input type='submit' value='发布' /></form><br />
_END;

    if (isset($_GET['erase']))
    {
        $erase = sanitizeString($_GET['erase']);
        queryMysql("DELETE FROM messages WHERE id=$erase AND recip='$user'");
    }
    
    $query  = "SELECT * FROM messages WHERE recip='$view' ORDER BY time DESC";
    $result = queryMysql($query);
    $num    = mysql_num_rows($result);
    
    for ($j = 0 ; $j < $num ; ++$j)
    {
        $row = mysql_fetch_row($result);

        if ($row[3] == 0 || $row[1] == $user || $row[2] == $user)
        {
            echo date('M jS \'y g:ia:', $row[4]);
            echo " <a href='messages.php?view=$row[1]'>$row[1]</a> ";

            if ($row[3] == 0)
                 echo "： &quot;$row[5]&quot; ";
            else echo "小声说: <span class='whisper'>" .
                      "&quot;$row[5]&quot;</span> ";

            if ($row[2] == $user)
                echo "[<a href='messages.php?view=$view" .
					      "&erase=$row[0]'>删除</a>]";

            echo "<br>";
        }
    }
}

if (!$num) echo "<br /><span class='info'>暂无消息</span><br /><br />";

echo "<br /><a class='button' href='messages.php?view=$view'>查看新消息</a>";
?>

</div><br /></body></html>
