 <?php
 sleep(30);
                     $filepath = "F:\wamp\www\structure_question_answering\upload_train\log\\train.log";
                                            $file = fopen($filepath, 'r');
                                            for($i=0;$i<50000;$i++){
                                                $result = fgets($file);
                                                if($result){
                                                    echo $result;
                                                }
                                            }                           
                                    ?>