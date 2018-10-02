<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>数据结构问答系统</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

        <link rel="stylesheet" type="text/css" href="assets/css/normalize.css" />
        <link rel="stylesheet" type="text/css" href="assets/css/default.css">
        <link rel="stylesheet" href="assets/css/demo.css">
        <link rel="stylesheet" href="assets/css/ladda.min.css">
    </head>

    <body>
    <?php
        // $start=microtime(true); 
        #读取常见问答库中的内容
        error_reporting( E_ALL&~E_NOTICE );
        include "config/dbconnect.php";
        $sql = "SELECT * FROM `faq` ";
        $result = mysqli_query($link,$sql);
        $length = mysqli_affected_rows($link);
        $question = array();
        $answer = array();
        $faq = array();
        for($i=0;$i<$length;$i++){
            $sentence = mysqli_fetch_array($result);
            $question[$i] = $sentence['question'];
            $answer[$i] = $sentence['answer'];
            $faq[$i] = '问题：'.$sentence['question'].'  答案：'.$sentence['answer'];
        }
        #echo $question;   #$faq中存放的是常见问答对
        $flag = $_GET['flag'];
        if($flag == 2){
            $file_answer = fopen('F:\wamp\www\structure_question_answering\LSI_TFIDF\similar_answer.txt', 'r');
            $length_file = filesize("F:\wamp\www\structure_question_answering\LSI_TFIDF\similar_answer.txt");
        }elseif ($flag == 1) {
            $file_answer = fopen('F:\wamp\www\structure_question_answering\knowledge\similar_answer.txt', 'r');
            $length_file = filesize("F:\wamp\www\structure_question_answering\knowledge\similar_answer.txt");
        }
        $content = $_GET['question'];
        // $end=microtime(true); 
        // echo $end-$start;
    ?>
        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <!--<h1><strong>数据结构</strong> <b>问答系统</b></h1>-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9 col-sm-offset-2 form-box">
                        	<div class="form-bottom">
                        		<div class="form-top-left">
                            		<h3>数据结构 问答系统</h3>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-pencil"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="answer.php" method="post" class="login-form">
			                    	<div class="form-group">
			                        	<textarea type="text" name="question" placeholder="请输入你的问题...." class="form-username form-control" id="form-username"><?php echo $content; ?></textarea>
                                        <div class="button-demo">
                                            <button class="ladda-button" style="margin-left: 40%;margin-top: 3%;" data-color="mint" data-style="expand-right" data-size="s">查询</button>
                                            <input style="margin-left: 30%;" type="button" name="Submit" value="高级" class="btn" onclick="location.href='high.php'" />
                                            <input style="margin-left: 2%;" type="button" name="Submit" value="训练" class="btn" onclick="location.href='train.php'" />
                                        </div>
                                        <label style="margin-top: 2%;">
                                            <p>
                                            <?php
                                                // while(true){
                                                //     $result = exec("E:\anaconda3\python.exe LSI_TFIDF\LSI_model.py {$question} 2>error.txt 2>&1",$answer,$res);  
                                                // }
                                                // $start1=microtime(true); 
                                                if($flag == 2 && $length_file){
                                                    for($i=0;$i<$length_file;$i++){
                                                        $result = fgets($file_answer);
                                                        if($result){
                                                            $middle = str_replace("{","<b style='color:red;'>",$result);
                                                            $result = str_replace("}","</b>",$middle);
                                                            echo $result."<br/>";
                                                        }
                                                    }
                                                    echo "<br>";
                                                    echo "<b>答案来自：TF-IDF模型</b>"; 
                                                    // $end1=microtime(true); 
                                                    // echo $end1-$start1;
                                                }elseif($flag == 1 && $length_file){
                                                    // $start2=microtime(true); 
                                                    for($i=0;$i<$length_file;$i++){
                                                        $result = fgets($file_answer);
                                                        if($result){
                                                            $know_answer = "<b style='color:red;'>".$result."</b>";
                                                            echo $know_answer."<br/>";
                                                        }
                                                    }
                                                    echo "<br>";
                                                    echo "<b>答案来自：知识图谱</b>";
                                                    // $end1=microtime(true); 
                                                    // echo $end1-$start1;
                                                }elseif($flag && ($length_file)==0){
                                                    echo "<script>alert('查询失败');location.href='index.php';</script>";
                                                }
                                            ?>
                                            </p>
                                        </label>
			                        </div>
			                    </form>
		                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/retina-1.1.0.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        <script src="assets/js/spin.min.js"></script>
        <script src="assets/js/ladda.min.js"></script>
        <script>
            $(function () {
                $(".form-group").onclick(function () {
                    $("label").css("display", "block");
                },function(){
                    $("label").css("display", "none");
                })
            })

            var li_array = eval('<?php echo json_encode($question);?>');
            var answer = eval('<?php echo json_encode($answer);?>');
            var faq = eval('<?php echo json_encode($faq);?>');

            $('.form-control').on('input propertychange', function () {
                var sxs_in = $.trim($(".form-control").val());
                if (sxs_in) {
                    //此处一般是调接口将符合的数据填充到li中去
                    //这里就用本地数据
                    $("label p").remove();
                    for (j in faq) {
                        if (faq[j].indexOf(sxs_in) >= 0) {
                            data = faq[j].replace(sxs_in,"<b style='color:red;'>"+sxs_in+"</b>");
                            $("label").append("<p>" + data + "</p>");
                        }
                    }
                }
            })

            // Bind normal buttons
            //用来显示进度条，在timeout内，以200ms为间隔调用函数（转圈效果），知道最后返回结果则不旋转。
            Ladda.bind( '.button-demo button', { timeout: 200000 } );

            // Bind progress buttons and simulate loading progress
            Ladda.bind( '.progress-demo button', {
                callback: function( instance ) {          
                    var progress = 0;
                    var interval = setInterval( function() {
                        progress = Math.min( progress + Math.random() * 0.1, 1 );
                        instance.setProgress( progress );

                        if( progress === 1 ) {
                            instance.stop();
                            clearInterval( interval );
                        }
                    }, 200);
                }
            } );

        </script>
    </body>
</html>