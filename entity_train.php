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
        <link rel="stylesheet" type="text/css" href="assets/css/default.css"/>
        <link rel="stylesheet" href="assets/css/demo.css"/>
        <link rel="stylesheet" href="assets/css/ladda.min.css"/>

    </head>

    <body>
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
                            		<h3>实体抽取 训练</h3>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-spinner"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <div class="login-form">
			                    	<div class="button-demo">
                                        <button class="ladda-button" style="margin-left: 40%;height: 50px;width:120px;" data-color="mint" data-style="expand-right" data-size="s" onclick="javascript:window.location.href='?flag=1';window.open('entity_python.php ')">开始训练</button>
                                    <?php
                                        error_reporting( E_ALL&~E_NOTICE );
                                        $filepath = "F:\wamp\www\structure_question_answering\upload_train\log\\train.log";
                                        function show($filepath){
                                            set_time_limit(0);
                                            #防止php调用Python出现中文乱码
                                            $locale='en_US.UTF-8';
                                            setlocale(LC_ALL,$locale);
                                            putenv('LC_ALL='.$locale);

                                            header("Content-type:text/html;charset=utf-8");

                                            $file = fopen($filepath, 'r');
                                            $interval=10;//每隔一定时间运行
                                            $time = 0;
                                            echo "<textarea cols='100' style='margin-top:2%;height:200px;'>";
                                            do{
                                                $result = fread($file,'1000');
                                                echo $result;
                                                $time = $time + $interval;
                                                sleep($interval);
                                            }while($time <= 600);
                                            echo "</textarea>";
                                        }
                                        if($_GET["flag"]==1){
                                            show($filepath);
                                        }                                       
                                    ?>
                                    </div>
			                    </div>
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
            // Bind normal buttons
            //用来显示进度条，在timeout内，以200ms为间隔调用函数（转圈效果），知道最后返回结果则不旋转。
            Ladda.bind( '.button-demo button', { timeout: 2000000 } );

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