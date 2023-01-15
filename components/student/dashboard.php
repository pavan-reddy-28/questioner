<?php

require "./../../constants.php";
require "../../DAO/pdo.php";
session_start();

if(!(isset($_SESSION[StudentID]))){
   
    session_destroy();
    $host  = $_SERVER['HTTP_HOST'];
    header("Location: http://$host/Questioner/index.php");
}else{
  
 
    $data = (array)json_decode(getSubjects($_SESSION[SubjectID]));
    
    $professorDetails = (array)json_decode(professorDetailsOnSubject($_SESSION[SubjectID]));
   
    if($data['result'] == "success" ){
        $subjectDetails = (array)$data[0];
        $professorId = ((array)$professorDetails[0])['teacher_id'];
        $professorName = ((array)$professorDetails[0])['name'];
        
    }else{
        header("Refresh:0");
    }
}
?>

<html>


<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<title>Questioner</title>
</head>
    <style>
        body{
            background-color: #ffffff94;
        }
        .parentContainer {
            /* margin-top: 100px; */
            
            padding: 40px;
            width: 900px;
        }

        .childContainer {
           
            margin: auto;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }

        /* styles imported from w3schools : https://www.w3schools.com/howto/howto_css_flip_card.asp */
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 900px;
            margin: 20px;
            padding: 10px;
            text-align: center;
            font-family: arial;
        }

        .title {
            color: grey;
            font-size: 18px;
        }

        button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }


        button:hover,
        a:hover {
            opacity: 0.7;
        }
        .alert {
        width:800px;
        padding: 20px;
        background-color: #f44336;
        color: white;
        margin: auto;
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
.dashboard{
    font-size: 36px;
padding: 6px;
text-align: center;
width: 1300px;
background-color: black;
color: white;
border-radius: 10px;
margin: auto;
}
.lower{
    margin-bottom: 90px;
}
    </style>
</head>

<body style="font-family: sans-serif;">
   
  <?php require_once("./studentHeader.php") ?>
        <div class="parentContainer">
            <div style="display: flex;width:1300px;margin-top:20px;">
            <h1 class="dashboard">Student Dashboard</h1>
            </div>
            <div class="childContainer">
                

                    <div class="card">

                        <?php echo "<div style='height:190px;' ><h1>" . $professorName . "</h1>";
                        echo "<p class='title'>" . $subjectDetails['name'] . "</p>";
                        echo "<p style='white-space: break-spaces;'>" . $subjectDetails['description'] . "</p></div>";
                         echo "<p id='professor-id' style='display:none;'>" . $professorId . "</p>";
                        echo "<div><button id='details-page'>Click To View </button></div>";
                        ?>
                    </div>
                
            </div>

        </div>
    
    <div>
  
    </div>
    
   
  
</body>
<script>

    $(document).ready(function() {
        $("#details-page").click(function(){
           let pId=  $("#professor-id").html(); 
         
            document.location.href = "./questionspage.php?pId="+pId;
    });
        
    }) 
</script>
</script>

</html>


