<?php
require_once "./DAO/pdo.php";
require "./constants.php";
session_start();
if ((isset($_SESSION[ProfessorID]))) {
    $host  = $_SERVER['HTTP_HOST'];
    $studentDashboardPath = "/Questioner/components/professor/dashboard.php";
        
    header("Location: http://$host$studentDashboardPath");
   } 
   else if((isset($_SESSION[StudentID]))){
    $host  = $_SERVER['HTTP_HOST'];
    $studentDashboardPath = "/Questioner/components/student/dashboard.php";
        
    header("Location: http://$host$studentDashboardPath");
 
   }
if( isset($_POST['studentLogin']) ){
    if ( isset($_POST["smail"]) && isset($_POST["spassword"]) ) {
        $data = (array)json_decode(studentLogin( htmlspecialchars($_POST["smail"]), htmlspecialchars($_POST["spassword"])));
        
        if($data['result'] == "success"){
        
            $studentDashboardPath = "/Questioner/components/student/dashboard.php";
         $studentDetails = (array)$data[0];
         $_SESSION[StudentName] = $studentDetails['name'];
         $_SESSION[StudentID] = $studentDetails['student_id'];
         $_SESSION[SubjectID] = $studentDetails['subject_id'];
         $host  = $_SERVER['HTTP_HOST'];
         header("Location: http://$host$studentDashboardPath");

        }else{
            $_SESSION[PasswordErrorStudent] = "Invaild MailID or Password";
        }

    }
}else if(isset($_POST['professorLogin'])){
    if ( isset($_POST["pmail"]) && isset($_POST["ppassword"]) ) {
        $data = (array)json_decode(professorLogin(htmlspecialchars($_POST["pmail"]), htmlspecialchars($_POST["ppassword"])));
        
        if($data['result'] == "success"){
            $professorDashboardPath = "/Questioner/components/professor/dashboard.php";
            $professorDetails = (array)$data[0];
    
            $_SESSION[ProfessorName] = $professorDetails['name'];
            $_SESSION[ProfessorID] = $professorDetails['teacher_id'];
            $_SESSION[SubjectID] = $professorDetails['subject_id'];
            $host  = $_SERVER['HTTP_HOST'];
            header("Location: http://$host$professorDashboardPath");


        }else{
            $_SESSION[PasswordErrorProfessor] = "Invaild MailID or Password";
        }

    }
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./components/styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Questioner</title>
</head>
<body>
<div class="main-container">
        <div class="left-container">
            <div class="card">
                <h1 class="heading">
                    STUDENT LOGIN
                </h1>
                <div class="container">
                    <div class="login-container">
                        <form method="post" >
                        <label for="email">Email</label>
                          <input type="mail"  name="smail" placeholder="xxxxx@ucmo.edu">
                          <label for="pass">Password</label>
                          <input type="password"  name="spassword" >
                          <input type="submit" name="studentLogin" value="Login">
                        </form>
                        <?php
                        if(isset($_SESSION[PasswordErrorStudent])){
                            echo "<p style='color:red;'>".$_SESSION[PasswordErrorStudent]."<p>";
                            unset($_SESSION[PasswordErrorStudent]);
                        }
                        ?>
                        
                      </div>
                </div>
              </div>
        </div>
        <div class="middle"></div>
        <div class="right-container">
            <div class="card">
                <h1 class="heading">PROFESSOR LOGIN</h1>
                <div class="container">
                    <div class="login-container">
                        <form method="post" >
                          <label for="email">Email</label>
                          <input type="mail"  name="pmail" placeholder="xxxxx@ucmo.edu">
                      
                          <label for="pass">Password</label>
                          <input type="password"  name="ppassword" >
                          <input type="submit" name="professorLogin" value="Login">
                        </form>
                        <?php
                        if(isset($_SESSION[PasswordErrorProfessor])){
                            echo "<p style='color:red;'>".$_SESSION[PasswordErrorProfessor]."<p>";
                            unset($_SESSION[PasswordErrorProfessor]);
                        }
                        ?>
                      </div>
                </div>
              </div>
        </div>
  
    </div>
</body>
</html>