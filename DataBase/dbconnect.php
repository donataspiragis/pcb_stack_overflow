    <?php
include('../config.php');
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    Class Connection {
   	
	private $servername = DBHOST;
	private $username = DBUSER;
	private $password = DBPWD;
	private $dbname = DBNAME;
    	protected $con;
     
                public function openConnection()
                 {
                   try
                     {
              $this->con = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
		$this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              return $this->con;
                      }
                   catch (PDOException $e)
                     {
                         echo "There is some problem in connection: " . $e->getMessage();
                     }
                 }
    public function closeConnection() {
         $this->con = null;
      }
    }
 
