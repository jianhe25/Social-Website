<?php
include_once 'header.php';
echo "<div class='main'>";

function parse($num) {
    if ($num > 16)
        return "三十二进十六";
    else if ($num > 8)
        return "十六进八";
    else if ($num > 4)
        return "八进四";
    else if ($num > 2)
        return "半决赛";
    else
        return "决赛";
}

$contest = "";
if (isset($_GET['view']))
{
    $contest = sanitizeString($_GET['view']);

    if (!mysql_num_rows(queryMysql("SELECT * FROM contests 
        WHERE contest = '$contest'")))
    {
        die("该比赛不存在");
    }
} else 
    die("该比赛不存在");

$error = "";
$contestant = "";
$score = "";
$period = "";
if (isset($_POST['contestant'])) {
    $contestant = sanitizeString($_POST['contestant']);
    $score = intval(sanitizeString($_POST['score']));

    if ($contestant == "" || $score == "") {
        $error = "运动员名字/分数必须完整";
    } else {
        if (!mysql_num_rows(queryMysql("SELECT * FROM scores WHERE contest='$contest'
                AND ='$contestant'"))) {
            queryMysql("INSERT INTO scores VALUES('$contestant', '$contest', '$score')");
        } else {
            queryMysql("UPDATE scores SET score='$score' WHERE contest='$contest'
                AND user='$contestant'");
        }
    }
}

$result = queryMysql("SELECT * FROM scores WHERE contest = '$contest'");
$num    = mysql_num_rows($result);
$status = parse($num);
echo "<h3>$contest"."$status"."：</h3>";

for ($i = 0; $i < $num; ++$i) {
    $row = mysql_fetch_row($result);
    echo "<li>$row[0]"."的成绩：$row[2]";
}

if ($user == "admin") {
echo <<<_END
<form method='post' action='schdule.php?view=$contest'>$error
<br>赛程： <select name="period" size="1">
<option value="final">决赛</option>
<option value="semi_final">半决赛</option>
<option value="top_eight">八进四</option>
<option value="top_sixteen">十六进八</option>
<option value="top_thirtytwo">三十二进十六</option>
</select> <br><br>

<span class='fieldname'>运动员</span>
<input type='text' maxlength='20' name='contestant' 
    value='$contestant'/><span id='info'></span><br />

<span class='fieldname'>成绩：</span>
<input type='number' maxlength='20' name='score' 
    value='$score'/><span id='info'></span><br />
<span class='fieldname'>&nbsp;</span>
<input type='submit' value='添加运动员' />
</form></div><br /></body></html>
_END;
}
?>

