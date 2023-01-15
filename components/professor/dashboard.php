<?php

require "./../../constants.php";
require "../../DAO/pdo.php";
session_start();

if(!(isset($_SESSION[ProfessorID]))){
   
    session_destroy();
    $host  = $_SERVER['HTTP_HOST'];
    header("Location: http://$host/Questioner/index.php");
}else{
    $data = (array)json_decode(getSubjects($_SESSION[SubjectID])); 
    if($data['result'] == "success" ){
        $subjectDetails = (array)$data[0];
    }else{
        header("Refresh:0");
    }
}
?>

<html>

<head>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
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
   
  <?php require_once("./professorHeader.php") ?>
        <div class="parentContainer">
            <div style="display: flex;width:1300px;margin-top:20px;">
            <h1 class="dashboard">Professor DashBoard</h1>
            </div>
            <div class="childContainer">
                

                    <div class="card">

                        <?php echo "<div style='height:190px;' ><h1>" . $subjectDetails['name']. "</h1>";
                
                        echo "<p style='white-space: break-spaces;'>" . $subjectDetails['description'] . "</p></div>";

                        echo "<div><button id='view-details'>Click To View Posted Questions</button></div>";
                        ?>
                    </div>
                
            </div>

        </div>
    
    <div>
  
    </div>
    
    
  
</body>
<script>
     $(document).ready(function() {
        $("#view-details").click(function(){
            document.location.href = "./questionspage.php";
    });
        
    }) 
   </script>

</html>


