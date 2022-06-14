<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../css/fun.css">
    <style>
    table td{
            height: 25px;
            text-align: center;
            font-size: 13px;
            padding: 30px;
        }
    table td a {
            background: green;
            color: #eee;
            display: inline-block;
            clear: both;
            width: 65px;
            height: 20px;
            text-decoration:none;
            border: 2px;
            border-color:black;
            border-width: 2px;
            border-style: outset;
            border-color: buttonborder;
            border-image: initial;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <th style="min-width: 6%;">学号</th>
        <th style="min-width: 6%;">姓名</th>
        <th style="min-width: 6%;">学院</th>
        <th style="min-width: 6%;">班级</th>
        <th style="min-width: 6%;">平均成绩</th>
        <th style="min-width: 6%;">已修学分</th>
        <th style="min-width: 6%;">详细</th>
    </tr>
    <?php
    require_once("../../config/database.php");

    $com="select * from
(select sid,name,did,dname,class,sex,avg_score from
(select sid,name,did,class,sex,avg_score from
(select sid,avg(score) as avg_score
from student_course
where status=0 and score is not null
group by sid) as v1 natural join student) as v2
natural join department) as v3 natural join
(select sid,sum(credit) as sum_credit from (select sid,cid,credit from
(select distinct sid,cid from student_course where score>60)
as v4 natural join course) as v5 group by sid) as v6 where 1=1" ;
    

    if($_GET['sid']){
        $com=$com." and sid like '%".$_GET['sid']."%'";
    }
    if($_GET['name']){
        $com=$com." and name like '%".$_GET['name']."%'";
    }
    if($_GET['class']){
        $com=$com." and class like '%".$_GET['class']."%'";
    }
    if($_GET['did']){
        $com=$com." and did like '%".$_GET['did']."%'";
    }

    $result=mysqli_query($db,$com);
    if($result){
        while($row=mysqli_fetch_object($result)){
            ?>
            <tr>
                
                <td><?php echo $row->sid ?></td>
                <td><?php echo $row->name ?></td>
                <td><?php echo $row->dname ?></td>
                <td><?php echo $row->class ?></td>
                <td><?php echo $row->avg_score ?></td>
                <td><?php echo $row->sum_credit ?></td>
                <td><a href="getStuScore.php?sid=<?php echo $row->sid ?>">成绩详情</a></td>
            </tr>
            <?php
        }
    }

    mysqli_close($db);
    ?>
</table>
</body>
</html>