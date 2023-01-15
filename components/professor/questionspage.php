<?php

require "./../../constants.php";
require "../../DAO/pdo.php";
session_start();

if (!(isset($_SESSION[ProfessorID]))) {

    session_destroy();
    $host  = $_SERVER['HTTP_HOST'];
    header("Location: http://$host/Questioner/index.php");
} else {


    $data = (array)json_decode(getQuestions($_SESSION[ProfessorID], 'teacher'));

    $data = (array)$data[0];
}
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../styles/questions.css">
</head>
<style>
    body{
            background-color: #ffffff94;
        }
        .no-post{
            width: 1300px;
        }
</style>
<body>
    <?php require_once("./professorHeader.php") ?>
    <div class="main-container">
        <div class="parentContainer">
            <div style="display: flex;width:1300px;margin-top:20px;">
                <h1 class="dashboard">Questions Dashboard</h1>
            </div>
            <?php 
          
            for($index = 0 ; $index< (count($data)) ; $index++){
                $questionDetails = (array)$data[$index];
            ?>
            <div class="card">
                <div class="container">
                    <h2><span style='font-weight:200;'>Question: </span><b><span><?php echo $questionDetails['question'] ?></span></b></h2>
                    <?php echo "<p id='question_id-$index' style='display:none;'>" . $questionDetails['id'] . "</p>";?>
                    <?php echo "<button class='button' id='view-question-$index' style='vertical-align:middle;float:right;'><span>View Question </span></button>";?>
                </div>
            </div>
            <?php } 
            
            
            if(!(count($data)>0)){?>
                <div class="no-post">
                <div class="container" style="padding: 2px 16px;text-align: center;font-weight: 600;font-size: 21px;">
                    <h2><span style='font-weight:200;'>---------------NO QUESTIONS POSTED YET!!!--------------- </span><b><span><?php echo $questionDetails['question'] ?></span></b></h2>
                    </div>
            </div>
          <?php  }
            ?>

        </div>
    </div>
    <script>
         $(document).ready(function() {
            const len = document.getElementsByClassName("card").length;
            for(let i =0; i < len; i++ ){
                $(`#view-question-${i}`).click(function(){
                    const qID = $(`#question_id-${i}`).html();
                document.location.href = "./questionanswerpage.php?qId="+qID;
            });
            }
    }) 
    </script>
</body>
