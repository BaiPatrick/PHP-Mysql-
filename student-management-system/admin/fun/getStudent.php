<!DOCTYPE html>
<html>
<head>
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
    <th style="min-width: 3%;">性别</th>
    <th style="min-width: 3%;">年龄</th>
    <th style="min-width: 3%;">班级</th>
    <th style="min-width: 8%;">院系</th>
    <th style="min-width: 8%;">证件号码</th>
    <th style="min-width: 8%;">邮箱</th>
    <th style="min-width: 8%;">电话号</th>
    <th style="min-width: 6%;">操作</th>
</tr>
<?php
require_once("../../config/database.php");

$com='select * from student natural join (select did,dname from department) as didname where 1=1' ;
if($_POST['sid']){
    $com=$com.' and sid like "%'.$_POST['sid'].'%"';
}
if($_POST['name']){
    $com=$com.' and name like "%'.$_POST['name'].'%"';
}
if($_POST['sex']){
    $com=$com.' and sex="'.$_POST['sex'].'"';
}
if($_POST['age']){
    $com=$com.' and age='.$_POST['age'];
}
if($_POST['class']){
    $com=$com.' and class like "%'.$_POST['class'].'%"';
}
if($_POST['dname']){
    $com=$com.' and dname like "%'.$_POST['dname'].'%"';
}
if($_POST['idnum']){
    $com=$com.' and idnum like "%'.$_POST['idnum'].'%"';
}
if($_POST['email']){
    $com=$com.' and email like "%'.$_POST['email'].'%"';
}
if($_POST['tel']){
    $com=$com.' and tel like "%'.$_POST['tel'].'%"';
}

$result=mysqli_query($db,$com);
if($result){
    while($row=mysqli_fetch_object($result)){
        ?>
        <tr>
            <td><?php echo $row->sid ?></td>
            <td><?php echo $row->name ?></td>
            <td><?php echo $row->sex ?></td>
            <td><?php echo $row->age ?></td>
            <td><?php echo $row->class ?></td>
            <td><?php echo $row->dname ?></td>
            <td><?php echo $row->idnum ?></td>
            <td><?php echo $row->email ?></td>
            <td><?php echo $row->tel ?></td>
            <td><a href="modiStudent.php?sid=<?php echo $row->sid?>">修改</a>  <a href="delStudent.php?sid=<?php echo $row->sid?>">删除</a></td>
        </tr>
        <?php
    }
}

mysqli_close($db);
?>
</table>
</body></html>
