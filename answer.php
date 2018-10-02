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
// $stime=microtime(true); 

setlocale(LC_ALL,$locale);
putenv('LC_ALL='.$locale);

header("Content-type:text/html;charset=utf-8");

#把问题中的问号去掉
$str=str_replace('？','',$_POST['question']); 
$question = urlencode($str);

#得到三元组中的实体 当存在该实体时说明可以用三元组来得到答案
$file_entity = fopen('entity2id.txt', 'r');
$length_file = filesize("entity2id.txt");
$result = array();
for($i=0;$i<$length_file;$i++){
	$var = fgets($file_entity);
	if($var){
		$result[$i] = str_replace(array("\r\n", "\r", "\n"), "", $var);
	}else{
		break;
	}
}

#用部分特殊连接词来切分问句，根据问句中的实体名称来选择TF-IDF模型还是知识图谱
$length = count($result);# 三元组中不重复的实体，$length为实体的数量
$num = 0;
$decode_question = $_POST['question'];

$tag = ['是','有','包括','采用','利用','的'];
foreach($tag as $v){
	$decode_question = str_replace(array("\r\n", "\r", "\n"), "", $decode_question);  #有隐藏的换行符，需要去掉
	$index = strpos($decode_question,$v);   #得到问句中首次出现数组tag中的索引
	if($index){
		$new_question = substr($decode_question,0,$index);
		break;
	}else{
		$new_question = $decode_question;
	}
}
// #优先选择知识图谱来查询，当查询失败时选择TF-IDF进行模糊查询
// #首先从问题中识别实体名
// $etime=microtime(true); 
// echo $etime-$stime;

if(in_array($new_question, $result)){
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
		echo "<script type='text/javascript'>location='index.php?flag=1&question=$question&total=$total';</script>";
	}
}else{
	#TF-IDF模型
	$stime=microtime(true);
	// $tagging = exec("E:\anaconda3\python.exe parser\parser.py {$question} 2>error.txt 2>&1",$out,$res);  #res = 0表示外部程序python运行成功
	// var_dump($out);  #此时的$out为parser.py返回的值，包括将句法分析后的结果存入文件中
	// $etime=microtime(true); 
	// echo $etime-$stime;
	// echo "<br>";

	#下面是运行TF-IDF.pys
	// $HED = urlencode($out[1]);
	// echo $HED;
	$result = exec("E:\anaconda3\python.exe LSI_TFIDF\LSI_model.py {$question} 2>error.txt 2>&1",$answer,$res);  
	// var_dump($answer);
	if($answer){
		$etime1=microtime(true); 
		// echo $etime1-$etime;
		// echo "<br>";
		$total = $etime1-$stime;
		echo "<script type='text/javascript'>location='index.php?flag=2&question=$question&total=$total';</script>";
	}
}
 // $etime=microtime(true);        
 // $total=$etime-$stime;   //计算差值
 // echo $total;
?>

</body>
</html>