<?php
$username = "php";
$password = "phpdb";
$databaseName = "questioner";
$hostname = "localhost";
$portNumber = 8889;

$databaseConfiguration = "mysql:host=$hostname;dbname=$databaseName;port=$portNumber";

try {
    $pdo = new PDO(
        $databaseConfiguration,
        $username,
        $password,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
    
} catch (PDOException $ex) {
    echo ("DB error - " . $ex->getMessage());
}

function studentLogin($usermail, $password)
{
    try {
        $sql = "SELECT * FROM student WHERE 
            mail=:mail 
            AND 
            password =:password";
        $statment = $GLOBALS['pdo']->prepare($sql);
        $statment->execute(array(
            ':mail' => $usermail,
            ':password' => $password
        ));
        $response = array();
        $row = $statment->fetch(PDO::FETCH_ASSOC);
        if (count($row) == 1) {

            $response = array("result" => "error");
            return json_encode($response, JSON_PRETTY_PRINT);
        } else {
            // $row["result"] = "success";
            $response[] = $row;
              $response["result"]="success";
        }
    } catch (PDOException $ex) {
        $response = array("result" => "error");
        return json_encode($response, JSON_PRETTY_PRINT);
        echo $ex->getMessage();
    }
    return json_encode($response, JSON_PRETTY_PRINT);
}


function professorLogin($usermail, $password)
{
    try {
        $sql = "SELECT * FROM teacher WHERE 
                mail=:mail 
                AND 
                password =:password";
        $statment = $GLOBALS['pdo']->prepare($sql);
        $statment->execute(array(
            ':mail' => $usermail,
            ':password' => $password
        ));
        $response = array();
        $row = $statment->fetch(PDO::FETCH_ASSOC);
        if (count($row) == 1) {

            $response = array("result" => "error");
            return json_encode($response, JSON_PRETTY_PRINT);
        } else {
            $response[] = $row;
            $response["result"]="success";
        }
    } catch (PDOException $ex) {
        $response = array("result" => "error");
        return json_encode($response, JSON_PRETTY_PRINT);
        echo $ex->getMessage();
    }
    return json_encode($response, JSON_PRETTY_PRINT);
}
function professorDetailsOnSubject($subject_id){
    try {
        $sql = "SELECT name,teacher_id FROM teacher WHERE 
                subject_id=:subject_id 
                ";
        $statment = $GLOBALS['pdo']->prepare($sql);
        $statment->execute(array(
            ':subject_id' => $subject_id
        ));
        $response = array();
        $row = $statment->fetch(PDO::FETCH_ASSOC);
        
            $response[] = $row;
            $response["result"]="success";
        
    } catch (PDOException $ex) {
        $response = array("result" => "error");
        return json_encode($response, JSON_PRETTY_PRINT);
        echo $ex->getMessage();
    }
    return json_encode($response, JSON_PRETTY_PRINT);

}
function getSubjects($subject_id)
{

    try {
        $sql = "SELECT * FROM subjects WHERE 
                subject_id=:subject_id";

        $statment = $GLOBALS['pdo']->prepare($sql);

        $statment->execute(array(
            ':subject_id' => $subject_id
        ));
        $response = array();
        $row = $statment->fetch(PDO::FETCH_ASSOC);
        if (count($row) == 1) {

            $response = array("result" => "error");
            return json_encode($response, JSON_PRETTY_PRINT);
        } else {
            $response[] = $row;
            $response["result"]="success";
        }
    } catch (PDOException $ex) {
        $response = array("result" => "error");
        return json_encode($response, JSON_PRETTY_PRINT);
        echo $ex->getMessage();
    }
    return json_encode($response, JSON_PRETTY_PRINT);
}

function getQuestions($id, $person)
{
    try {
        if ($person == "teacher") {
            $sql = "SELECT * FROM questions WHERE 
            teacher_id=:teacher_id";

            $statment = $GLOBALS['pdo']->prepare($sql);

            $statment->execute(array(
                ':teacher_id' => $id,
            ));
        } else if ($person == "student") {
            $sql = "SELECT * FROM questions WHERE 
            student_id=:student_id";

            $statment = $GLOBALS['pdo']->prepare($sql);

            $statment->execute(array(
                ':student_id' => $id,
            ));
        }
        
        $rows = array();

        while ( $row = $statment->fetch(PDO::FETCH_ASSOC) ) {
          $rows[] = $row;
        }

        $response = array();
        // $row = $statment->fetch(PDO::FETCH_ASSOC);
        $response[] = $rows;
          
            $response["result"]="success";
        
    } catch (PDOException $ex) {
        $response = array("result" => "error");
        return json_encode($response, JSON_PRETTY_PRINT);
        echo $ex->getMessage();
    }
    return json_encode($response, JSON_PRETTY_PRINT);
}


function getSingleQuestion($question_id)
{
    try {
        $sql = "SELECT * FROM questions WHERE 
                id=:question_id";
        $statment = $GLOBALS['pdo']->prepare($sql);

        $statment->execute(array(
            ':question_id' => $question_id,
        ));

        $response = array();
        $row = $statment->fetch(PDO::FETCH_ASSOC);
        if (count($row) == 1) {

            $response = array("result" => "error");
            return json_encode($response, JSON_PRETTY_PRINT);
        } else {
            $response[] = $row;
            $response["result"]="success";
            
        }
    } catch (PDOException $ex) {
        $response = array("result" => "error");
        return json_encode($response, JSON_PRETTY_PRINT);
        echo $ex->getMessage();
    }
    return json_encode($response, JSON_PRETTY_PRINT);
}


function sendQuestion($question, $professor_id, $student_id)
{
    try {
        $sql = "INSERT INTO questions (question, teacher_id, student_id, answer ) 
    VALUES (:question, :teacher_id, :student_id, :answer)";
        $stmt = $GLOBALS['pdo']->prepare($sql);
        if ($stmt->execute(array(':question' => $question, ':teacher_id' => $professor_id, ':student_id' => $student_id, ':answer'=> 'novalue'))) {
            $response = array("result" => "success");
        }
    } catch (PDOException $ex) {
        $response = array("result" => "error");
        return json_encode($response, JSON_PRETTY_PRINT);
        echo $ex->getMessage();
    }
    return json_encode($response, JSON_PRETTY_PRINT);
}

function sendAnswer($answer, $question_id)
{
    try {
        $sql = "UPDATE questions 
    SET answer=:answer 
    WHERE id =:question_id";

        $newStmt = $GLOBALS['pdo']->prepare($sql);
        if ($newStmt->execute(array(':answer' => $answer, ':question_id' => $question_id))) {
            $response = array("result" => "success");
        }
    } catch (PDOException $ex) {
        $response = array("result" => "error");
        return json_encode($response, JSON_PRETTY_PRINT);
        echo $ex->getMessage();
    }

    return json_encode($response, JSON_PRETTY_PRINT);
}




// echo "<br><pre>";
// print_r((array)json_decode(getQuestions("80001", "teacher")));
// echo "</pre>";
