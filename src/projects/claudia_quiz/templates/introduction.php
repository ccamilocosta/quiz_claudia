<?php
   
   // Start session; configure and load standard includes
   include '../config.php';
    
    
if(isset($_GET['quizID'])) {
    
    $quizID = $_GET['quizID'];
}

else {
    $quizID = 1;
}

$_SESSION['quizID'] = $quizID;

$pageData = introductionDataFromDB($quizID);


 // Initialize achieved number of points
 $_SESSION['achievedPoints'] = 0;
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/main.css">
</head>

<body>
        <div class="caption">
            <span class="border">
                <?php
                echo '<a href="/index.php">' . $pageData['title'] . '</a>';     
                ?>
            </span>
            <form action="<?php echo $pageData['nextAction']; ?>" method="post">
                <input type="hidden" name="nextQuestionID" 
                value="<?php echo $pageData['nextQuestionID']; ?>"><br>
                
                <input class= "submitbuttom" type="submit" value="START">
                <img class="giraff" src="/projects/claudia_quiz/images/giraffedef.png" >
            </form>
            <div class='footer'>
        </div>
    </div>
</div>
</div>
</body>

</html>