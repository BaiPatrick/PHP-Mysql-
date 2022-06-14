<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/fun.css">
    <title>Title</title>
    <style>
        a{
        color: #eee;
        display: block;
        clear: both;
        width: 64px;
        height: 19px;
        background: red;
        margin: 10px auto;
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
<form action="./fun/getLog.php" method="get" target="resultbox">
    <h3 class="subtitle">学生管理 >> 奖惩管理</h3>
    <div class="inputbox"><span>学号：</span><input name="sid" type="text"></div>
    <div class="inputbox"><span>姓名：</span><input name="name" type="text"></div>
    <div class="inputbox"><span>班级：</span><input name="class" type="text"></div>
    <div class="clickbox clearfloat"><input name="submit" type="submit" value="提交"></div>
    <div class="clickbox"><a href="./addLog.php">新增</a></div>
    

</form>

<iframe name="resultbox" frameborder="0" width="100%" height=690px ></iframe>
</body>
</html>