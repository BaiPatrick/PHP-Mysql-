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
            font-size: 15px;
            padding: 20px;
        }
        table td a {
            background: green;
            color: #eee;
            display: inline-block;
            clear: both;
            width: 44px;
            height: 20px;
            margin:0 0 20px 0 ;
            text-decoration:none;
            padding: 1px 6px;
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
        <th style="min-width: 6%;">课程号</th>
        <th style="min-width: 6%;">课程名</th>
        <th style="min-width: 6%;">教师名</th>
        <th style="min-width: 6%;">开课学院</th>
        <th style="min-width: 6%;">选课人数</th>
        <th style="min-width: 6%;">已修人次</th>
        <th style="min-width: 6%;">平均分数</th>
        <th style="min-width: 6%;">操作</th>
    </tr>
    <?php
    require_once("../../config/database.php");

    $com="select * from course left join (select did,dname from department)as v1 on course.did=v1.did left join
(select cid,count(sid) as taking from student_course natural join course where score is null group by cid) as v2 on course.cid=v2.cid left join
(select cid,count(sid) as finished ,avg(score) as avg_score from student_course natural join course where score is not null group by cid) as v3 on course.cid=v3.cid  where 1=1" ;
    

    if($_GET['cid']){
        $com=$com." and course.cid like '%".$_GET['cid']."%'";
    }
    if($_GET['cname']){
        $com=$com." and cname like '%".$_GET['cname']."%'";
    }
    if($_GET['tname']){
        $com=$com." and tname like '%".$_GET['tname']."%'";
    }
    if($_GET['did']){
        $com=$com." and v1.did like '%".$_GET['did']."%'";
    }
    //mysqli_query(connection,query,resultmode) 函数执行某个针对数据库的查询。
    //connection 规定要使用的mysql连接
    //query规定查询的字符串
    $result=mysqli_query($db,$com);
    if($result){
        while($row=mysqli_fetch_object($result)){
            ?>
            <tr>
                
                <td><?php echo $row->cid ?></td>
                <td><?php echo $row->cname ?></td>
                <td><?php echo $row->tname ?></td>
                <td><?php echo $row->dname ?></td>
                <td><?php if($row->taking==0)echo "0";else echo $row->taking ?></td>
                <td><?php if($row->finished==0)echo "0";else echo $row->finished ?></td>
                <td><?php echo $row->avg_score ?></td>
                <td><a href="getClassScore.php?cid=<?php echo $row->cid ?>">详情</a></td>
            </tr>
            <?php
        }
    }

    mysqli_close($db);
    ?>
</table>
</body>
</html>