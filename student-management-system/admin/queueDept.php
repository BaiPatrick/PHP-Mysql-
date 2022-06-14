<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>院系信息</title>
    <link rel="stylesheet" type="text/css" href="./css/fun.css">
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
    <h3 class="subtitle">院系管理 >> 院系列表</h3>
<table>
    <tr>
        <th style="min-width: 6%;">院系序号</th>
        <th style="min-width: 6%;">院系名称</th>
        <th style="min-width: 6%;">所在地址</th>
        <th style="min-width: 6%;">负责人</th>
        <th style="min-width: 6%;">联系方式</th>
        <th style="min-width: 6%;">操作</th>
    </tr>
    <?php
    require_once("../config/database.php");
    $com='select * from department order by did' ;
    
    $result=mysqli_query($db,$com);
    if($result){
        //mysqli_fetch_object 从结果集中取得当前行，并作为对象返回。
        while($row=mysqli_fetch_object($result)){
            ?>
            <tr>
                
                <td><?php echo $row->did ?></td>
                <td><?php echo $row->dname ?></td>
                <td><?php echo $row->dadd ?></td>
                <td><?php echo $row->dmng ?></td>
                <td><?php echo $row->dtel ?></td>
                <td><a href="./fun/modiDept.php?did=<?php echo $row->did; ?>">修改</a></td>
            </tr>
            <?php
        }
    }

    mysqli_close($db);
    ?>
</table>
</body>
</html>