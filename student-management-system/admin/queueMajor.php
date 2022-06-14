<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/fun.css">
    <title>院系管理 >> 专业列表</title>
    <style>
        a{
        color: #eee;
        display: block;
        clear: both;
        width: 64px;
        height: 19px;
        background: red;
        margin: 5px auto;
        text-align:center;
        text-decoration:none;
        padding: 1px 6px;
        border: 2px;
        border-color:black;
        border-width: 2px;
        border-style: outset;
        border-color: buttonborder;
        border-image: initial;
        font-size: 14.5px;
        }
    </style>
</head>
<body>
<h3 class="subtitle">院系管理 >> 专业查询</h3>
<form action="./fun/getMajor.php" method="get" target="resultbox">
     <div class="twocols inputbox"><span>院系：</span>
    <?php
    require_once '../config/database.php';
    echo '<select name="did">';
    $dept=mysqli_query($db,"select did,dname from department");
    while($dr=mysqli_fetch_object($dept)) {
        var_dump($dr);
        echo '<option value="'.$dr->did.'" ';  echo '> '.$dr->dname.'</option>' ;
    }
    echo '</select>';
    mysqli_close($db);
    ?></div>
    <div class="clickbox clearfloat"><span></span><input name="submit" type="submit" value="提交"></div>
    <a  href="./fun/addMajor.php" target="resultbox">新增专业</a>

</form>
<iframe name="resultbox" frameborder="0" width="100%" height=500px ></iframe>
</body>
</html>