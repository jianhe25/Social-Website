<?php
include_once 'header.php';
echo "<div class='main'>";

$result = queryMysql("SELECT * FROM contests");
$num    = mysql_num_rows($result);
for ($j = 0 ; $j < $num ; ++$j)
{
    $row = mysql_fetch_row($result);    
    $contest = $row[0];

    $contest_result = queryMysql("SELECT * FROM scores WHERE contest='$contest' 
    	ORDER BY score DESC");
    $contest_num = mysql_num_rows($contest_result);

	echo "<h2><a href='schdule.php?view=$contest'>$contest</a>"."的前三名:<br></h2>";
	
	for ($k = 0; $k < $contest_num && $k < 3; ++$k) {
		$contest_row = mysql_fetch_row($contest_result);
		echo "<li>$contest_row[0]"."  ："."$contest_row[2]";
	}
}
?>

</form></div><br /></body></html>
