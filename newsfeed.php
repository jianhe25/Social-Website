<?php
include_once 'header.php';


if (!$loggedin) die();

if (isset($_POST['text'])) {
	$text = sanitizeString($_POST['text']);
	if ($text != "") {
		$time = time();
		queryMysql("INSERT INTO status VALUES(NULL, '$time','$user', '$text')");
	}
}
?>
<form method='post' action='newsfeed.php'>
<textarea name='text' rows='3' class = "status-content" placeholder="What's in your mind?"></textarea><br />
<input type='submit' value='Post' class='btn' style="margin-left:20px;"/></form><br />

<?php
{
	$newsfeed = queryMysql("SELECT * FROM status WHERE user in 
							(SELECT user FROM friends WHERE friend='$user')
							OR user='$user'
							ORDER BY time DESC");
	$num = mysql_num_rows($newsfeed);
	#echo "<div class='row-fluid'>";
	for ($i = 0; $i < $num; ++$i)
	{
		$row = mysql_fetch_row($newsfeed);
		

	echo  	"<div class='a-feed'>".
			"<h5><a href='profile.php?view=$row[2]'> $row[2]</a></h5>".
			"<p>$row[3]</p>".
			"</div>";
			
	}
	#echo "</div>";
}
?>

