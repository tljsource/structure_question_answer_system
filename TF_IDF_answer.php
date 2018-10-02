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
error_reporting( E_ALL&~E_NOTICE );
$locale='en_US.UTF-8';

setlocale(LC_ALL,$locale);
putenv('LC_ALL='.$locale);

header("Content-type:text/html;charset=utf-8");

#把问题中的问号去掉
$str=str_replace('？','',$_POST['question']); 
$question = urlencode($str);

#TF-IDF模型
$stime=microtime(true); 
$result = exec("E:\anaconda3\python.exe LSI_TFIDF\LSI_model.py {$question} 2>error.txt 2>&1",$answer,$res);  
// var_dump($answer);
if($answer){
	$etime1=microtime(true); 
	$total = $etime1-$stime;
	echo "<script type='text/javascript'>location='TF_IDF.php?flag=1&question=$question&total=$total';</script>";
}
?>

</body>
</html>