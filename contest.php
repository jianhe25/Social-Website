<?php
include_once 'header.php';
echo "<div class='main'>";

echo "<h2>田径比赛</h2><ul>";

$contest = "";
$description = "";
$time = "";
if (isset($_POST['contest']))
{
    $contest = sanitizeString($_POST['contest']);
    $description = sanitizeString($_POST['description']);
    $time = sanitizeString($_POST['time']);

    if ($contest == "" || $description == "" || $time == "")
        $error = "比赛名/描述/时间必须完整<br /><br />";
    else
    {
        if (mysql_num_rows(queryMysql("SELECT * FROM contests
              WHERE contest='$contest'")))
            $error = "该比赛已存在<br /><br />";
        else
          {
            queryMysql("INSERT INTO contests VALUES('$contest', '$description', '$time')");
        }
    }
}

$result = queryMysql("SELECT * FROM contests");
$num    = mysql_num_rows($result);
for ($j = 0 ; $j < $num ; ++$j)
{
    $row = mysql_fetch_row($result);    
    echo "<li><a href='schdule.php?view=$row[0]'>$row[0]</a>"."<br>时间：$row[2]<br>";
    echo "<div>描述：$row[1]</div><br>";
}

if ($user == "admin") {
echo <<<_END
    <form method='post' action='contest.php'>
    <span class='fieldname'>名称：</span>
    <input type='text' maxlength='20' name='contest' value='$contest'/><span id='info'></span><br />
    <span class='fieldname'>时间：</span>
    <input type='text' maxlength='20' name='time' value='$time'/><span id='info'></span><br />
    <h3>比赛描述：</h3>
    <textarea name='description' cols='50' rows='3'>$description</textarea><br />
    <span class='fieldname'>&nbsp;</span>
    <input type='submit' value='添加比赛' />
    </form></div><br /></body></html>
_END;
}
?>


