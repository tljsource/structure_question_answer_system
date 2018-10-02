<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>问题查询</title>
</head>
<body>

<?php
#防止php调用Python出现中文乱码
$locale='en_US.UTF-8';
setlocale(LC_ALL,$locale);
putenv('LC_ALL='.$locale);

header("Content-type:text/html;charset=utf-8");

$recognition = exec("E:\anaconda3\python.exe knowledge\question.py {$question} 2>error.txt 2>&1",$entity,$res);
#此时得到问题中的实体（特指问句），实体对（求关系，可能是是非问句与特指问句），实体关系对（求另一个实体，特指问句）
$knowledge = exec("E:\anaconda3\python.exe knowledge\answer.py {$question} 2>error.txt 2>&1",$know,$res);
#var_dump($know);

if($know){
	echo"<script type='text/javascript'>location='index.php?flag=1&question=$question';</script>";
}

?>

</body>
</html>