<?php
session_start();
$sid=$_SESSION["user"];
require_once("../config/database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./user.css">
    <style>
        table th{
            font-size: 15px;
            padding: 6px;
            height: 38px;
       }
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
            width: 44px;
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
    <h3>重修查询</h3>
    <h4>正在重修课程</h4>
<table>
    <tr>
        <th style="min-width: 6%;">课程号</th>
        <th style="min-width: 6%;">课程名</th>
        <th style="min-width: 6%;">学分</th>
        <th style="min-width: 6%;">教师名</th>
    </tr>
    <?php

    $com="select * from course natural join (select * from student_course where sid='$sid' and status='1' and score is null) as chosen  " ;
    
    $result=mysqli_query($db,$com);
    if($result){
        while($row=mysqli_fetch_object($result)){
            ?>
            <tr>
                <td><?php echo $row->cid ?></td>
                <td><?php echo $row->cname ?></td>
                <td><?php echo $row->credit ?></td>
                <td><?php echo $row->tname ?></td>
            </tr>
            <?php
        }
    }
    ?>
</table>
<h4>已重修课程</h4>
<table>
    <tr>
        <th style="min-width: 6%;">课程号</th>
        <th style="min-width: 6%;">课程名</th>
        <th style="min-width: 6%;">学分</th>
        <th style="min-width: 6%;">教师名</th>
        <th style="min-width: 6%;">成绩</th>
    </tr>
    <?php

    $com="select * from course natural join (select * from student_course where sid='$sid' and status='1' and score is not null) as chosen  " ;
    
    $result=mysqli_query($db,$com);
    if($result){
        while($row=mysqli_fetch_object($result)){
            ?>
            <tr>
                <td><?php echo $row->cid ?></td>
                <td><?php echo $row->cname ?></td>
                <td><?php echo $row->credit ?></td>
                <td><?php echo $row->tname ?></td>
                <td><?php echo $row->score ?></td>
            </tr>
            <?php
        }
    }
    ?>
</table>
<h4>不及格课程记录</h4>
<table>
    <tr>
        <th style="min-width: 6%;">课程号</th>
        <th style="min-width: 6%;">课程名</th>
        <th style="min-width: 6%;">学分</th>
        <th style="min-width: 6%;">教师名</th>
        <th style="min-width: 6%;">成绩</th>
    </tr>
    <?php

    $com="select * from course natural join (select * from student_course where sid='$sid' and status='0' and score<60 ) as chosen  " ;
    
    $result=mysqli_query($db,$com);
    if($result){
        while($row=mysqli_fetch_object($result)){
            ?>
            <tr>
                <td><?php echo $row->cid ?></td>
                <td><?php echo $row->cname ?></td>
                <td><?php echo $row->credit ?></td>
                <td><?php echo $row->tname ?></td>
                <td><?php echo $row->score ?></td>
            </tr>
            <?php
        }
    }
    mysqli_close($db);
    ?>
</table>
</body>
</html>
