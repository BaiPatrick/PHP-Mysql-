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
    <h3>选课管理</h3>
<table>
    <tr>
        <th style="min-width: 6%;">课程号</th>
        <th style="min-width: 6%;">课程名</th>
        <th style="min-width: 6%;">学分</th>
        <th style="min-width: 6%;">地点</th>
        <th style="min-width: 6%;">教师名</th>
        <th style="min-width: 6%;">操作</th>
    </tr>
    <?php

    $com="select * from course natural join (select cid from student_course where score is null and sid='$sid') as chosen" ;
    
    $result=mysqli_query($db,$com);
    if($result){
        while($row=mysqli_fetch_object($result)){
            ?>
            <tr>
                <td><?php echo $row->cid ?></td>
                <td><?php echo $row->cname ?></td>
                <td><?php echo $row->credit ?></td>
                <td><?php echo $row->cadd ?></td>
                <td><?php echo $row->tname ?></td>
                <td><a href="delCourse.php?cid=<?php echo $row->cid."&sid=".$row->sid; ?>">退选</a></td>
            </tr>
            <?php
        }
    }

    mysqli_close($db);
    ?>
</table>
</body>
</html>