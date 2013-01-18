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

echo "<h3>Other members</h3>".
	 "<div id='userList' class = 'UserList'>".
	 "<ul>";

for ($j = 0 ; $j < $num ; ++$j)
{
    $row = mysql_fetch_row($result);
    if ($row[0] == $user) continue;
   
    echo "<li>";
	echo "<a href='members.php?view=$row[0]' class='UserPic'>";
	if (file_exists($row[0].".jpg"))
		echo "<img src='$row[0].jpg' onload='clipImage(this)'>";
	else
		echo "<img src='default.jpg' onload='clipImage(this)'>";
	echo "</a>";
?>
	<p class='UserInformation'>
	<?php echo "<strong> <a href='members.php?view=$row[0]'>$row[0]</a> <strong>"; ?>
	</p>
	<div class='UserModify'>
	
<?php	
	$follow = "Follow";
	$t1 = mysql_num_rows(queryMysql("SELECT * FROM friends
        WHERE user='$row[0]' AND friend='$user'"));
    $t2 = mysql_num_rows(queryMysql("SELECT * FROM friends
        WHERE user='$user' AND friend='$row[0]'"));

    if (($t1 + $t2) > 1) echo " &harr; Your friend";
    elseif ($t1)         echo " &larr; You are following";
    elseif ($t2)       { echo " &rarr; is following you";
	                      $follow = "Accept"; }
    
    if (!$t1) echo " [<a href='members.php?add=$row[0]'>$follow</a>]";
    else      echo " [<a href='members.php?remove=$row[0]'>Unfollow</a>]";
	
	echo "</div>".
		 "</li>";
}

?>
</ul>
</div>
</div>
</body></html>
