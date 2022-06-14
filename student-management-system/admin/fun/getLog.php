<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../css/fun.css">
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
            border-color:black;
            border-width: 2px;
            border-style: outset;
            border-color: buttonborder;
            border-image: initial;
        }
        a:first-child {
            background: green;
        }
        a:nth-child(2) {
        background: red;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <th style="min-width: 6%;">学号</th>
        <th style="min-width: 5%;">姓名</th>
        <th style="min-width: 3%;">班级</th>
        <th style="min-width: 3%;">奖惩</th>
        <th style="min-width: 8%;">缘由</th>
        <th style="min-width: 8%;">详情</th>
        <th style="min-width: 9%;">发生时间</th>
        <th style="min-width: 4%;">录入时间</th>
        <th style="min-width: 10%;">操作</th>
    </tr>
    <?php
    require_once("../../config/database.php");

    $com='select * from student_log left join (select sid sid2,name from student) as sname on student_log.sid=sname.sid2 where 1=1 ' ;
    if($_GET['sid']){
        $com=$com." and sid like '%".$_GET['sid']."%'";
    }
    if($_GET['name']){
        $com=$com." and name like '%".$_GET['name']."%'";
    }
    if($_GET['class']){
        $com=$com." and class like '%".$_GET['class']."%'";
    }
    
    $result=mysqli_query($db,$com);
    if($result){
        while($row=mysqli_fetch_object($result)){
            ?>
            <tr>
                
                <td><?php echo $row->sid ?></td>
                <td><?php echo $row->name ?></td>
                <td><?php echo $row->class ?></td>
                <td><?php
                    if ($row->type==1){
                        echo '奖';
                    }
                    else{
                        echo '惩';
                    }
                    ?></td>
                <td><?php echo $row->reason ?></td>
                <td><?php echo $row->detail ?></td>
                <td><?php echo $row->logdate ?></td>
                <td><?php echo $row->addtime ?></td>
                <td><a href="modiLog.php?sid=<?php echo $row->sid."&addtime=".$row->addtime; ?>">修改</a>  <a href="delLog.php?sid=<?php echo $row->sid."&addtime=".$row->addtime; ?>">删除</a></td>
            </tr>
            <?php
        }
    }

    mysqli_close($db);
    ?>
</table>
</body>
</html>