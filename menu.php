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

        <link href="http://ox6yf62u0.bkt.clouddn.com/semantic-ui/2.2.13/semantic.min.css" rel="stylesheet">
        <script src="http://ox6yf62u0.bkt.clouddn.com/semantic-ui/2.2.13/semantic.min.js"></script>
        <style>
        .topheader>a {
            padding-right: 15px;
            color: black;
            background-color: #fff;
            /* text-decoration:underline; */
            font-weight: bold;
        }

        a {
            text-decoration: underline;
            color: rgba(109, 99, 99, 0.76);
            font-size: 5px;
        }


        .bri {
            display: inline-block;

            right: 10px;
            width: 60px;
            height: 23px;

            color: #fff;
            background: #38f;
            line-height: 24px;
            font-size: 13px;
            text-align: center;
            overflow: hidden;
            /*border-bottom: 1px solid #38f;*/
            margin-left: 19px;
            margin-right: 2px;
        }
        </style>
    </head>

    <body>
    <?php
    error_reporting( E_ALL&~E_NOTICE );
    $number = $_GET['number'];
    ?>
        <div class="ui right aligned  topheader fluid container" style="padding: 30px">
        <a href="high.php" style="background:none;">高级</a>
        <a href="train.php" style="background:none;">训练</a>
        <a href="http://www.baidu.com" style="background:none;">百度</a>
    </div>
        <!-- Top content -->
    <div class="ui centered aligned grid container " style="margin-top: 2%;">
        <div class="row">
            <div class="column" style="width: 270px;height: 129px;">
                <img class="ui  image"  src="logo/logo.jpg" alt="">
            </div>
        </div>
        <div class="row">
            <form class="column" style="width:640px;" method="post" action="index1.php" name="search">
                <div class="ui fluid  input action">
                    <input type="text" name="wd" placeholder="请输入问题..." oninput="OnInput(event)">
                    <button class="medium ui blue button" onclick="document.forms['search'].submit();">查询</button>
                </div>
            </form>
        </div>
    </div>
    <div class="ui one column center aligned stackable grid " style="margin-top: 15%;">
        <div class="column" style="color:rgba(109, 99, 99, 0.76);font-size:5px">
            <a href="#">关于问答</a>
            <a href="#">about QA</a>
            <a href="#">问答推广</a>
            </br>
            2018 QA
            <a href="#" style="text-decoration-line:underline">使用问答系统前必读</a>
            <a href="#" style="text-decoration-line: underline">意见反馈</a>>
            <i class="marker icon"></i> 浙江工商大学智慧教育工作室
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
            function OnInput (event) {
                var inputValue = event.target.value;
                var number = eval('<?php echo json_encode($number);?>');
                window.location.href = 'index1.php?number='+number;
            }
        </script>
    </body>
</html>