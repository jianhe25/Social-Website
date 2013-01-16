<html><head><title>Setting up database</title></head><body>

<h3>Setting up...</h3>

<?php 
include_once 'functions.php';

queryMysql("DROP TABLE contests");
queryMysql("DROP TABLE scores");
queryMysql("DROP TABLE members");
queryMysql("DROP TABLE profiles");
queryMysql("DROP TABLE friends");
queryMysql("DROP TABLE messages");
queryMysql("DROP TABLE status");

createTable('members',
            'user VARCHAR(16) PRIMARY KEY,
            pass VARCHAR(16),
            INDEX(user(6))');

createTable('messages', 
            'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            auth VARCHAR(16),
            recip VARCHAR(16),
            pm CHAR(1),
            time INT UNSIGNED,
            message VARCHAR(4096),
            INDEX(auth(6)),
            INDEX(recip(6))');

createTable('status',
            'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,            
            time INT UNSIGNED,
            user VARCHAR(16),
            status VARCHAR(140),
            INDEX(user(6))');

createTable('friends',
            'user VARCHAR(16),
            friend VARCHAR(16),
            INDEX(user(6)),
            INDEX(friend(6))');

createTable('profiles',
            'user VARCHAR(16),
            text VARCHAR(4096),
            INDEX(user(6))');

createTable('scores',
            'user VARCHAR(16),
            contest VARCHAR(20),
            score INT');

createTable('contests',
            'contest VARCHAR(20) PRIMARY KEY,
            decription VARCHAR(4096),
            start_time VARCHAR(16)');

queryMysql("INSERT INTO contests VALUES('100米短跑', 
      '100米短跑非常考验爆发力，是速度与美的体现',
      '2012年11月3日')");
queryMysql("INSERT INTO contests VALUES('400米接力', 
      '该项目是非常考验团队合作的集体项目，四个人分别跑一百米并交棒',
      '2012年11月3日')");
queryMysql("INSERT INTO contests VALUES('110米栏', 
      '该项目是中国第一个在奥运会夺金的田径项目，刘翔是该项目的偶像,会不会自动换行呢',
      '2012年11月3日')");


queryMysql("INSERT INTO profiles VALUES('admin', 
      'I am the boss!')");
queryMysql("INSERT INTO profiles VALUES('李挣', 
      '但求一炮！')");
queryMysql("INSERT INTO profiles VALUES('胡敏', 
      '我是大敏神')");
queryMysql("INSERT INTO profiles VALUES('何剑', 
      '蛋疼哥，不解释')");
queryMysql("INSERT INTO profiles VALUES('魏荣磊', 
      '教主威武，千秋万代')");
queryMysql("INSERT INTO profiles VALUES('陈克', 
      '把的一手好妹')");
queryMysql("INSERT INTO profiles VALUES('李罡', 
      '我是蛋疼罡！')");
queryMysql("INSERT INTO profiles VALUES('吴广原', 
      '快填表，明天早上要交')");
queryMysql("INSERT INTO profiles VALUES('龚凯', 
      '我是大吃货！')");

queryMysql("INSERT INTO members VALUES('admin', 
      '123456')");
queryMysql("INSERT INTO members VALUES('李挣', 
      '123456')");
queryMysql("INSERT INTO members VALUES('胡敏', 
      '123456')");
queryMysql("INSERT INTO members VALUES('何剑', 
      '123456')");
queryMysql("INSERT INTO members VALUES('魏荣磊', 
      '123456')");
queryMysql("INSERT INTO members VALUES('陈克', 
      '123456')");
queryMysql("INSERT INTO members VALUES('李罡', 
      '123456')");
queryMysql("INSERT INTO members VALUES('吴广原', 
      '123456')");
queryMysql("INSERT INTO members VALUES('龚凯', 
      '123456')");

queryMysql("INSERT INTO scores VALUES('何剑', 
      '100米短跑',
      80)");
queryMysql("INSERT INTO scores VALUES('胡敏', 
      '100米短跑',
      90)");
queryMysql("INSERT INTO scores VALUES('李挣', 
      '100米短跑',
      100)");
queryMysql("INSERT INTO scores VALUES('陈克', 
      '100米短跑',
      60)");


queryMysql("INSERT INTO scores VALUES('吴广原', 
      '110米栏',
      100)");
queryMysql("INSERT INTO scores VALUES('李罡', 
      '110米栏',
      80)");
queryMysql("INSERT INTO scores VALUES('魏荣磊', 
      '110米栏',
      90)");
queryMysql("INSERT INTO scores VALUES('何剑', 
      '110米栏',
      70)");
queryMysql("INSERT INTO scores VALUES('陈克', 
      '110米栏',
      88)");
queryMysql("INSERT INTO scores VALUES('龚凯', 
      '110米栏',
      77)"); 
queryMysql("INSERT INTO scores VALUES('胡敏', 
      '110米栏',
      77)"); 
queryMysql("INSERT INTO scores VALUES('李挣', 
      '110米栏',
      80)"); 
queryMysql("INSERT INTO friends VALUES('何剑', '李挣')");
queryMysql("INSERT INTO friends VALUES('李挣', '何剑')");
queryMysql("INSERT INTO friends VALUES('龚凯', '何剑')");
queryMysql("INSERT INTO friends VALUES('何剑', '龚凯')");
queryMysql("INSERT INTO friends VALUES('何剑', '陈克')");
queryMysql("INSERT INTO friends VALUES('陈克', '何剑')");
?>



<br />...done.
</body></html>
