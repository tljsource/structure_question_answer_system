<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>

    <body>
<?php  
    //1.接收提交文件的用户  
    $filename=$_POST['filename'];  
      
    //获取文件的大小  
    $file_size=$_FILES['myfile']['size'];  
    if($file_size>5*1024*1024) {  
        echo "文件过大，不能上传大于2M的文件";  
        exit();  
    }  
  
    $file_type=$_FILES['myfile']['type'];  
    var_dump($_FILES['myfile']);

    if($file_type!="text/plain") {  
        echo "文件类型只能为txt格式";  
        exit();  
    }  
    //判断是否上传成功（是否使用post方式上传）  
    if(is_uploaded_file($_FILES['myfile']['tmp_name'])) {  
        //把文件转存到你希望的目录（不要使用copy函数）  
        $uploaded_file=$_FILES['myfile']['tmp_name'];  
  
        //我们给每个用户动态的创建一个文件夹  
        $user_path=$_SERVER['DOCUMENT_ROOT']."/structure_question_answering/upload_entity_file/";  
        //判断该用户文件夹是否已经有这个文件夹  
        if(!file_exists($user_path)) {  
            mkdir($user_path);  
        }  
  
        //$move_to_file=$user_path."/".$_FILES['myfile']['name'];  
        $file_true_name=$_FILES['myfile']['name'];  
        $move_to_file=$user_path."/".$file_true_name;  
        //echo "$uploaded_file   $move_to_file";  
        if(move_uploaded_file($uploaded_file,iconv("utf-8","gb2312",$move_to_file))) {  
            echo "<script type='text/javascript'>alert('上传成功');location='train.php?filename=$file_true_name';</script>";  
        } else {  
            echo "<script type='text/javascript'>alert('上传失败');location='file_upload.php';</script>"; 
        }  
    } else {  
        echo "<script type='text/javascript'>alert('上传失败');location='file_upload.php';</script>"; 
    }  
?>  
</body>
</html>