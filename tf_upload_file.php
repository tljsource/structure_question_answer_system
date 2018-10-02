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
                            		<h3 style="margin-left: 50%;">txt文件上传</h3>
                                    <p style="margin-left: 20%;">说明：文件由语句或者段落组成, 代码需过滤
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-pencil"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
                            <form enctype="multipart/form-data" method="post" action="tf_uploadprocess.php" class="login-form">  
                            <label style="margin-left: 20%;color: blue;">请上传txt文件(必须是utf-8编码)</label>
                            <table style="margin-left: 20%;"> 
                            <tr><td>文件名：</td><td><input type="text" name="filename"/></td></tr>  
                            <tr><td>文件浏览：</td><td><input type="file" name="myfile"/></td></tr>  
                            <tr><td><input type="submit" value="上传文件"/></td><td></td></tr>  
                            </table>  
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

    </body>

</html>