<?php

require "./../../constants.php";
require "../../DAO/pdo.php";
session_start();

if (!(isset($_SESSION[ProfessorID]))) {

    session_destroy();
    $host  = $_SERVER['HTTP_HOST'];
    header("Location: http://$host/Questioner/index.php");
} else {
    $check = $_GET['qId'];
    if ($check != "none") {
        $data = (array)json_decode(getSingleQuestion($check));
        $data = (array)$data[0];
    }
    if(isset($_POST["postAnswer"]) && isset($_POST['answerValue']) && isset($_POST['questionId']) && ($_POST['answerValue']!="")){
        $postAnswer = $_POST["answerValue"];
        $questionId = $_POST['questionId'];
        $values = (array)json_decode(sendAnswer($postAnswer,$questionId));
        if($values['result'] == "success"){
            $host  = $_SERVER['HTTP_HOST'];
            header("Location: http://$host/Questioner/components/professor/questionspage.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../styles/questionanswer.css">
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
</head>

<body>

    <div class="main-container">
    <?php require_once("./professorHeader.php") ?>
    <div style="display: flex;width:1300px;margin-top:38px;">
                <h1 class="dashboard">Professor Query Page</h1>
            </div>
        <div class="card">
            <div class="container">
                <form method="post">
                    <div class="row" style="padding-top:20px;">
                        <div class="col-25">
                            <label for="fname">Question :</label>
                        </div>
                        <div class="col-75">
                            <input value="<?php echo htmlspecialchars($data['question']) ?>" type='text' id='qID' name='questionId' style="color:black;background-color: #cfd5d59c;" disabled>
                        </div>
                    </div>
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
                    <input name="questionId" value="<?php echo $check ?>" hidden >
                    <br>
                    <?php 
                             if($data['answer'] == "novalue"){?>
                                <div class="row">
                        <input type="submit" name="postAnswer" value="Post Answer">
                    </div> <?php
                             }else{?>
                                 <div class="row">
                        <input type="submit" name="postAnswer" value="Answer Posted!" disabled>
                    </div>
                         <?php    }
                            ?>
                   
                </form>
            </div>
        </div>
        <input type="button" class="dB-button"  value="Dashboard" />
    </div>


</body>
<script>
    $(document).ready(function() {
        $(".dB-button").click(function(){
            document.location.href = "./questionspage.php";
           
        })
        $("#subject").focus();
        let count = 1000;
        let len = $("#subject").val().length;
            $(".max-char").html(`<p class='max-char'>max char : ${count-len}</p>`);
       
        $(`#subject`).on('input', function() {
            let len = $("#subject").val().length;
            $(".max-char").html(`<p class='max-char'>max char : ${count-len}</p>`);
        });


    })
</script>

</html>