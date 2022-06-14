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
    <h3>奖惩查询</h3>
<table>
    <tr>
        <th style="min-width: 6%;">奖惩</th>
        <th style="min-width: 6%;">缘由</th>
        <th style="min-width: 6%;">详情</th>
        <th style="min-width: 6%;">发生时间</th>
        <th style="min-width: 6%;">录入时间</th>
        <th style="min-width: 6%;">操作</th>
    </tr>
    <?php

    $com="select * from student_log left join (select sid sid2,name from student) as sname on student_log.sid=sname.sid2 where sid='$sid' " ;
    
    $result=mysqli_query($db,$com);
    if($result){
        while($row=mysqli_fetch_object($result)){
            ?>
            <tr>
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
                <td><a href="modiLog.php?sid=<?php echo $row->sid."&addtime=".$row->addtime; ?>">修改</a></td>
            </tr>
            <?php
        }
    }

    mysqli_close($db);
    ?>
</table>
</body>
</html>