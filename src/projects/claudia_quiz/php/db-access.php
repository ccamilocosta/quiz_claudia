        <?php
        // define('DB_HOST', getenv('DB_HOST'));
        // define('DB_NAME', getenv('DB_NAME'));
        // define('DB_USER', getenv('DB_USER'));
        // define('DB_PASSWORD', getenv('DB_PASSWORD'));

        function DBConnection() {

        try{
            $connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', 
            DB_USER, 
            DB_PASSWORD
        );
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        catch (PDOException $e){
            
            echo'<p>DB connection failed: ' . $e->getMessage() . '</p>';

            echo 'HTPP_HOST = ' . $_SERVER['HTTP_HOST'] . '<br>';

            echo 'DB_NAME = ' . DB_NAME . '<br>';
            echo 'DB_USER = ' . DB_USER . '<br>';
            echo 'DB_PASSWORD = ' . DB_PASSWORD . 'br>';
            echo 'DB_HOST = ' .DB_HOST . '<br>';
            exit;        
        }

        return $connection;

    }
        
      if (strpos($_SERVER['HTTP_HOST'], 'localhost:') !== false) { 
        define('DB_HOST', getenv('DB_HOST'));
        define('DB_NAME', getenv('DB_NAME'));
        define('DB_USER', getenv('DB_USER'));
        define('DB_PASSWORD', getenv('DB_PASSWORD'));

      } 
      else {
        define('DB_HOST', 'ipilwig.mysql.db.internal');
        define('DB_NAME', 'ipilwig_cc');
        define('DB_USER', 'ipilwig_25');
        define('DB_PASSWORD', '1965');
      }
      
           
        function introductionDataFromDB($quizID){
            if(TRACE_DB_ACCESS) print "<h1>INTRODUCTION</h1>";
        
            $query  = DBConnection()->prepare("SELECT * FROM Introduction WHERE quizID = ?");
            $query->bindValue(1, $quizID);
            $query->execute();
        
            $data = $query->fetch(PDO::FETCH_ASSOC);
        
            //if(TRACE_DB_ACCESS){
               // var_dump($introduction);
                //echo "<p>------------------------------------------<p>";
            //}
            return $data;
        }
       
        function questionDataFromDB($quizID, $questionID) {
            if (TRACE_DB_ACCESS) print "<h1>QUESTION DATA</H1>";
            
            $query  = DBConnection()->prepare("SELECT * FROM Introduction WHERE quizID = ? AND id =?");
            $query->bindValue(1, $quizID);//er gibt/issues
            $query->bindValue(2, $questionID);
            $query->execute(); 

            $data = $query->fetch(PDO::FETCH_ASSOC);

            
            if (TRACE_DB_ACCESS) {
            var_dump($data);
            echo '<p> ........................</p>';
            }

            $data['answers'] = answerDataFromDB($questionID);
            return $data;


        }



        function answerDataFromDB($questionID) { 

            if (TRACE_DB_ACCESS) {
                print "<h1>ANSWER DATA</H1>";
            }
            $query  = $DBConnection()->prepare("SELECT text, correct FROM answer WHERE questionID = ?");
            $query->bindValue(1, $questionID); //er gibt/issues 
            $query->execute(); 

            $answers = $query->fetchALL(PDO::FETCH_ASSOC);

           // $data['answers'] = answerDataFromDB(questionID);
            if (TRACE_DB_ACCESS) {
            var_dump($data);
            echo '<p> ........................</p>';
            }

            return $answers;

        }

        function reportFromDB($quizID) { 

            if (TRACE_DB_ACCESS) {
                print "<h1>REPORT DATA</H1>";}

            $query  = DBConnection()->prepare("SELECT * FROM report WHERE quizID = ?");
            $query->bindValue(1, $quizID); 
            $query->execute(); 

            $report = $query->fetch(PDO::FETCH_ASSOC);

    
            if (TRACE_DB_ACCESS) {
            var_dump($totalQuestions);
            echo '<p> ........................</p>';
            }
            return $report;
       
        }

        function totalQuestionsFromDB($quizID) { 

            if (TRACE_DB_ACCESS) {
                print "<h1>TOTAL NUMBER OF QUESTIONS</H1>";}

            $query  = DBConnection()->prepare("SELECT id FROM Questions WHERE quizID = ?");
            $query->bindValue(1, $quizID); 
            $query->execute(); 

            $totalQuestions = $query->fetchALL(PDO::FETCH_ASSOC);

    
            if (TRACE_DB_ACCESS) {
            var_dump($totalQuestions);
            echo '<p> ........................</p>';
            }
            return $totalQuestions;
        }     
        
    ?>