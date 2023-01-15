<?php

require "./../../constants.php";
require "../../DAO/pdo.php";
session_start();

if (!(isset($_SESSION[StudentID]))) {

    session_destroy();
    $host  = $_SERVER['HTTP_HOST'];
    header("Location: http://$host/Questioner/index.php");
} else {
    $check = $_GET['qId'];
    $pId = $_GET['pId'];
    $returnPageId = $_GET['cID'];
    if ($check != "none") {
        $data = (array)json_decode(getSingleQuestion($check));
        $data = (array)$data[0];
    }
    if(isset($_POST["postQuestion"]) && isset($_POST['questionId'])){
        $newQuestion = $_POST['questionId'];
        $professorId = $_POST['professorId'];
        $values = (array)json_decode(sendQuestion($newQuestion,$professorId,$_SESSION[StudentID]));
        if($values['result'] == "success"){
            $host  = $_SERVER['HTTP_HOST'];
            header("Location: http://$host/Questioner/components/student/questionspage.php?pId=$professorId");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../styles/questionanswer.css">
</head>
<style>
    body{
            background-color: #ffffff94;
        }
        .card {
            box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%);
            transition: 0.3s;
            width: 1200px;
            border-radius: 5px;
            height: auto;
            margin-top: 25px;
            border: 4px solid black;
            border-radius: 48px;
            padding-bottom: 16px;
        }
    </style>
<body>
<?php require_once("./studentHeader.php") ?>
    <div class="main-container">
    <div style="display: flex;width:1300px;margin-top:38px;">
                <h1 class="dashboard">Student Query Page</h1>
            </div>
        <div class="card">
            <div class="container">
                <form method="post">
                    <div class="row" style="padding-top:20px;">
                        <div class="col-25">
                            <label for="fname">Question :</label>
                        </div>
                        <div class="col-75">
                            <?php
                            if ($check == "none") {
                            ?>
                                <input maxlength="400" type="text" id="qID" name="questionId" placeholder="Enter Question..">
                            <?php } else {
                            ?>
                                <input value="<?php echo htmlspecialchars($data['question']) ?>" type='text' id='qID' name='questionId' style="color:black;background-color: #cfd5d59c;" disabled>

                            <?php  } ?>
                        </div>
                    </div>
                                <input name="professorId" value="<?php echo $pId ?>" hidden >
                              <input name="xyz" id="returnID" value="<?php echo $returnPageId ?>" hidden >
                                <?php
                            if (! ($check == "none")) {
                                if($data['answer'] != "novalue"){
                            ?>
                                <div class="row" style="padding-top:20px;">
                        <div class="col-25">
                            <label for="fname">Answer :</label>
                        </div>
                        <div class="col-75">
                            <?php 
                             if($data['answer'] == "novalue"){?>
                                <textarea id="subject" name="answerValue" maxlength="1000" placeholder="........" style="height:200px;font-size:16px;"  ></textarea>
                           <?php
                             }else{?>
                                <textarea id="subject" name="answerValue" maxlength="1000" placeholder="........" style="height:200px;font-size:16px;" disabled  ><?php echo htmlspecialchars($data['answer']) ?></textarea>
                         
                         <?php    }
                            ?>
                             <p class="max-char">max char : 1000</p>
                        </div>
                    </div>
                    <?php }} ?>
                                <br>
                    <div class="row">
                    <?php
                            if (! ($check == "none")) {
                                if($data['answer'] != "novalue"){ 
                            ?>
                             <input type="submit" name="postQuestion" value="DONE!!" disabled >
                        <?php }else{?>
                        <input type="submit" name="postQuestion" value="In Review!!" disabled >
                                <?php }} else{ ?>
                        <input type="submit" name="postQuestion" value="Post Question">
                        <?php } ?>
                    </div>
                </form>
            </div>






        </div>
        <input type="button" class="dB-button"  value="Dashboard" />
    </div>


</body>
<script>
     $(".dB-button").click(function(){
        
        const cID = $(`#returnID`).val();
            document.location.href = "./questionspage.php?pId="+cID;
           
        })
</script>
</html>
