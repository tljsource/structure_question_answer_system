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
        <link rel="stylesheet" href="assets/css/buttons.css">
    </head>

    <body>
    <?php
        // $start=microtime(true); 
        #读取常见问答库中的内容
        date_default_timezone_set('prc');
        error_reporting( E_ALL&~E_NOTICE );
        include "config/dbconnect.php";
        $sql = "SELECT * FROM `faq` ";
        $result = mysqli_query($link,$sql);
        $length = mysqli_affected_rows($link);
        $question = array();
        $answer = array();
        $faq = array();
        // echo $length;
        for($i=0;$i<$length;$i++){
            $sentence = mysqli_fetch_array($result);
            $question[$i] = str_replace('\r\n','',$sentence['question']);
            $answer[$i] = str_replace('\r\n','',$sentence['answer']);
            $faq[$i] = '问题：'.$sentence['question'].'  答案：'.$sentence['answer'];
        }
        #echo $question;   #$faq中存放的是常见问答对
        $content = $_POST['word'];  #用户提交的问题,接受到说明已经提交
        $number = $_GET['number'];  #哪个用户提问

        #根据问题采用知识图谱或者TF-IDF技术来进行搜索，默认先用知识图谱，搜索失败再使用TF-IDF技术
        // var_dump($content);        
        // $file_question = fopen('knowledge\question.txt', 'a+');
        // if($content){
            // $asktime = date('y-m-d h:i:s',time()); #提问的时间点
            #$sen = $number.' '.$content.' '.$asktime
            #fwrite($file_question, string)
            // $sql1 = "INSERT INTO `ask_know`(`username`, `question`, `asktime`) VALUES ('$number','$content','$asktime')";
            // mysqli_query($link,$sql1);
        // } 
    ?>
        <!-- Top content -->

        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-9 col-sm-offset-2 form-box">
                        <div class="form-bottom">
                            <form role="form" action="" method="post" class="login-form">
                                <div class="form-group" style="text-align: center;">
                                    <input name="tn" type="hidden">
                                    <img src="logo/logo8.jpg" alt="qa" align="bottom" border="0">
                                    <input type="text" name="word" size="50" class="question" id="form-control" value="<?php echo $content;?>">
                                    <!-- <a href="" class="button button-raised button-royal">查询</a> -->
                                    <button class="button button-raised button-royal" type="submit">查询</button>
                                    <div style="margin-left: 5%;">
                                    <label style="margin-top: 5%;">
                                        <p align="left">
                                        <?php
                                            if($content){
                                                #读取知识图谱返回的结果
                                                $file_q = fopen('knowledge\question.txt','w');
                                                fwrite($file_q, $content);
                                                #等待知识图谱处理完成
                                                usleep(100000);
                                                $file_know = fopen('knowledge\similar_answer.txt','r');
                                                $length = filesize('knowledge\similar_answer.txt');
                                                if($length){
                                                    for($i=0;$i<$length;$i++){
                                                        $result = fgets($file_know);
                                                        if($result){
                                                            echo "<b style='color:red;'>".$result."</b>";
                                                            echo "<br/>";
                                                        }
                                                    }
                                                    echo "<br>";
                                                    echo "答案来自知识图谱";
                                                }else{
                                                    #读取TF-IDF返回的结果
                                                    $file_q = fopen('LSI_TFIDF\question.txt','w');
                                                    fwrite($file_q, $content);
                                                    #等待知识图谱处理完成
                                                    usleep(600000);
                                                    $file_tf = fopen('LSI_TFIDF\similar_answer.txt','r');
                                                    $length = filesize('LSI_TFIDF\similar_answer.txt');
                                                    for($i=0;$i<$length;$i++){
                                                        $result = fgets($file_tf);
                                                        echo $result;
                                                        
                                                        /*
                                                        if($result){
                                                            if(strpos($result,'{')!== false || strpos($result,'}')!== false){
                                                                $middle = str_replace("{","<b style='color:red;'>",$result);
                                                                $result = str_replace("}","</b>",$middle);
                                                                echo $result."<br/>";        
                                                            }elseif(strpos($result,$content)!== false){
                                                                $split =  explode('。',$result,-1); 
                                                                if(strpos($split[0],$content)!== false){
                                                                    $result = "<b style='color:red;'>".$split[0]."</b>"."。".$split[1];
                                                                    echo $result."<br/>";
                                                                }elseif(strpos($split[1],$content)!== false){
                                                                    $result = $split[0]."。"."<b style='color:red;'>".$split[1]."</b>";
                                                                    echo $result."<br/>";
                                                                }
                                                            }else{
                                                                $split =  explode('。',$result,-1); 
                                                                $similar1 = similar_text($split[0],$content);
                                                                $similar2 = similar_text($split[0],$content);
                                                                if($similar1>$similar2){
                                                                    $result = "<b style='color:red;'>".$split[0]."</b>"."。".$split[1];
                                                                    echo $result; 
                                                                }elseif($similar1<=$similar2){
                                                                    $result = $split[0]."。"."<b style='color:red;'>".$split[1]."</b>";
                                                                    echo $result."<br/>";
                                                                }
                                                            }
                                                            */
                                                        }
                                                    }
                                                echo "<br/>";
                                                echo "来自TF-IDF";
                                            }
                                        ?>
                                        </p>
                                    </label>
                                    </div>
                                </div>
                            </form>
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
                $(".form-group").onclick(function(){
                    $("label").css("display", "block");
                },function(){
                    $("label").css("display", "none");
                })
            })
            // alert("daozhe ");
            var li_array = eval('<?php echo json_encode($question);?>');
            var answer = eval('<?php echo json_encode($answer);?>');
            var faq = eval('<?php echo json_encode($faq);?>');
            $('.question').on('input propertychange', function () {
                var sxs_in = $.trim($(".question").val());
                if (sxs_in) {
                    //此处一般是调接口将符合的数据填充到li中去
                    //这里就用本地数据
                    $("label p").remove();
                    for (j in faq) {
                        if (faq[j].indexOf(sxs_in) >= 0) {
                            data = faq[j].replace(sxs_in,"<b style='color:red;'>"+sxs_in+"</b>");
                            $("label").append("<p align='left'>" + data + "</p>");
                            // alert(data);
                        }
                    }
                }
            })
            </script>

        <script>  
        setTimeout("document.getElementById(\"form-control\").focus()",50); //自动显示
        </script>
    </body>
</html>