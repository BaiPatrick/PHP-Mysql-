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
        background: red;
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
        <th style="min-width: 6%;">学分</th>
        <th style="min-width: 6%;">上课地址</th>
        <th style="min-width: 6%;">开课学院</th>
        <th style="min-width: 6%;">教师名</th>
        <th style="min-width: 6%;">操作</th>
    </tr>
    <?php
   require_once("../../config/database.php");

    $com='select * from course natural join (select did,dname from department) as didname where 1=1  ' ;
    if($_GET['cid']){
        $com=$com." and cid like '%".$_GET['cid']."%'";
    }
    if($_GET['cname']){
        $com=$com." and cname like '%".$_GET['cname']."%'";
    }
    if($_GET['credit']){
        $com=$com." and credit like '%".$_GET['credit']."%'";
    }
    if($_GET['cadd']){
        $com=$com." and cadd like '%".$_GET['cadd']."%'";
    }
    if($_GET['dname']){
        $com=$com." and dname like '%".$_GET['dname']."%'";
    }
    if($_GET['tname']){
        $com=$com." and tname like '%".$_GET['tname']."%'";
    }

    $result=mysqli_query($db,$com);
    if($result){
        while($row=mysqli_fetch_object($result)){
            ?>
            <tr>
                
                <td><?php echo $row->cid ?></td>
                <td><?php echo $row->cname ?></td>
                <td><?php echo $row->credit ?></td>
                <td><?php echo $row->cadd ?></td>
                <td><?php echo $row->dname ?></td>
                <td><?php echo $row->tname ?></td>
                <td><a href="./delClass.php?cid=<?php echo $row->cid ?>">删除</a></td>
            </tr>
            <?php
        }
    }

    mysqli_close($db);
    ?>
</table>
</body>
</html>