<?php

    include '../config.php';

    // Start the session and initialize the result array
   // session_start();
    // Preset path to include folder
   //set_include_path($_SERVER['DOCUMENT_ROOT'] . '/claudia_quiz/php');

    // Page includes
    // include 'auth.php';
    // include 'quiz-ckue-data.php';
    // include 'question.php';
    // include 'db-access.php'

    if(isset($_GET['quizID'])) {
        $quizID = $_GET['quizID'];
    }else{
        $quizID =1; 
    }

  
  $_SESSION['quizID'] = $quizID;

    // Get quiz data
   
    $pageData = reportFromDB($quizID);

    $totalQuestions = totalQuestionsFromDB($quizID);
    
    $_SESSION['achievedPoints'] = $_SESSION['achievedPoints'] + $_POST['radio'];

   // $percentage = $_SESSION['achievedPoints'] = $_SESSION['a/b'] *100 = $_POST['c%'];
    $percentage = ($_SESSION['achievedPoints']/count($totalQuestions) * 100);
  


?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/claudia_quiz/css/main.css">
</head>

<body>
    <div class="bgimg-1">
        <div class="caption">
            <span class="border">
           
            <?php 

            
                    
                echo '<a href="/index.php">' . $pageData['title'] . '</a>';

                echo '<p>You have answered ' . $_SESSION['achievedPoints'] . 'out of' . count($totalQuestions) . 'correctly</p> ';

                echo 'question(s) correctly ('. $percentage.'%).' . ' </p>';        
              
                if ($percentage >= 80){
                    echo '<p>' . $pageData['feedback_1'] . '</p>';
                 } 
      
                else if ($percentage >= 60){
                    echo '<p>' . $pageData['feedback_2'] . '</p>';
                }

                else {
                 echo '<p>' . $pageData['feedback_3'] . '</p>';
                }
            ?></span>
        </div>
    </div>
</body>

</html>