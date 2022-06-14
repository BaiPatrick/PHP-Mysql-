<?php

require_once("../../config/database.php");
?>
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
    <script>
    function addScore(sid,cid){
        var score = prompt("请输入成绩","");
        window.location.href="./addScore.php?sid="+sid+"&cid="+cid+"&score="+score;
    }
</script>
</head>
<body>
<table>
    <tr>
        <th style="min-width: 6%;">学号</th>
        <th style="min-width: 6%;">姓名</th>
        <th style="min-width: 6%;">课程号</th>
        <th style="min-width: 6%;">课程名</th>
        <th style="min-width: 6%;">教师</th>
        <th style="min-width: 6%;">学分</th>
        <th style="min-width: 6%;">重修成绩</th>
    </tr>
<?php
    $com="select * from student natural join student_course as v1 left join course on v1.cid=course.cid where status=1 " ;
    
    if($_GET['sid']){
        $com=$com." and sid like '%".$_GET['sid']."%'";
    }
    if($_GET['cid']){
        $com=$com." and cid like '%".$_GET['cid']."%'";
    }
    if($_GET['name']){
        $com=$com." and name like '%".$_GET['name']."%'";
    }
    if($_GET['cname']){
        $com=$com." and cname like '%".$_GET['cname']."%'";
    }
    if($_GET['tname']){
        $com=$com." and tname like '%".$_GET['tname']."%'";
    }
    $com=$com."order by score asc";

    $result=mysqli_query($db,$com);
    if($result){
        while($row=mysqli_fetch_object($result)){
            ?>
            <tr>
                <td><?php echo $row->sid ?></td>
                <td><?php echo $row->name ?></td>
                <td><?php echo $row->cid ?></td>
                <td><?php echo $row->cname ?></td>
                <td><?php echo $row->tname ?></td>
                <td><?php echo $row->credit ?></td>
                <td><?php if($row->score==NULL) echo("<a onclick='addScore($row->sid,$row->cid);' href='#'>登记成绩</a>"); else echo($row->score)?>
            </tr>
            <?php
        }
    }

    mysqli_close($db);
?>
</table>
</body>
</html>