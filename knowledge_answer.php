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
$stime=microtime(true); 
#防止php调用Python出现中文乱码
error_reporting( E_ALL&~E_NOTICE );
$locale='en_US.UTF-8';
// $stime=microtime(true); 

setlocale(LC_ALL,$locale);
putenv('LC_ALL='.$locale);

header("Content-type:text/html;charset=utf-8");

#把问题中的问号去掉
$str=str_replace('？','',$_POST['question']); 
$question = urlencode($str);

#首先从问题中识别实体名

$stime=microtime(true);
$recognition = exec("E:\anaconda3\python.exe knowledge\qa.py {$question} 2>error.txt 2>&1",$entity,$res);
#此时得到问题中的实体（特指问句），实体对（求关系，可能是是非问句与特指问句），实体关系对（求另一个实体，特指问句）
// var_dump($entity);
$entity_extractor = urlencode($entity[0]);
// var_dump($entity_extractor);
$knowledge = exec("E:\anaconda3\python.exe knowledge\answer.py {$entity_extractor} 2>error.txt 2>&1",$know,$res);
// var_dump($know);
if($know){
	$etime1=microtime(true); 
	$total = $etime1-$stime;
	echo "<script type='text/javascript'>location='knowledge.php?flag=1&question=$question&total=$total';</script>";
}
?>

</body>
</html>