    <?php
    include_once 'dbconnect.php';
    include_once 'importag.php';
    include_once 'importopic.php';
    include_once 'importex.php';


    try
    {
        $database = new Connection();
        $db = $database->openConnection();
        // inserting data into create table using prepare statement to prevent from sql injections
        importag('doctags',$db);
	importopic('topics',$db);
	importexample('examples',$db);
	
        echo "New record created successfully";
	//$db->closeConnection();
    }
    catch (PDOException $e)
    {
        echo "There is some problem in connection: " . $e->getMessage();
    }
 
$db = $database->closeConnection();








