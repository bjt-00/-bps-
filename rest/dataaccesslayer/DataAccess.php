 <?php 
 class DataAccess{
     
     	
   	public $host = "localhost";
   	public $user ="root";
   	public $password  ="";
   	public $db   ="bpos";
 


   	public $counter=0;
   	 function dbConnect(){
   		// initialize parameters
   		// connect to database
   		$db_connection = mysql_connect($this->host,$this->user,$this->password) or die("Connection failed");
		
		if (!$db_connection) { 
			die('Could not connect: ' . mysql_error()); 
		} 
		

   		mysql_select_db($this->db,$db_connection);	
   		return $db_connection;
		
   	}
    	
   	function getResult($query){
  		$db_connection = $this->dbConnect();
		mysql_query("set names utf8");
   		$result=mysql_query($query,$db_connection); 
   		return $result; 
   	}
   	function executeQuery($query){
   		//mysql_query("set names utf8");
   		$db = new mysqli($this->host,$this->user,$this->password,$this->db);
   		try {
   		$db->multi_query($query);
   		return $db->insert_id;
   		}catch (Exception $ex){
   		    $_SESSION[AppConstants::$ALERT_TYPE_ERROR]=$ex->getMessage();
   		}
   		return -1;
  	}
 	function getSize($resultset){
 		return mysql_num_rows($resultset);
 	}
	function getNoOfQueries(){
	$res = $this->getResult("SHOW SESSION STATUS LIKE 'Questions'");
	$row = mysql_fetch_array($res, MYSQL_ASSOC);
	define("TOTAL_QUERIES",$row['Value']);
	
	if(!isset($_SESSION['TOTAL_QUERIES'])){$_SESSION['TOTAL_QUERIES']=0;}
	$_SESSION['TOTAL_QUERIES'] +=(TOTAL_QUERIES-1);
	return $_SESSION["TOTAL_QUERIES"];
   }
   
   //replace special characters to avoid SQL Injection attacks
   function sqlInjectionFilter($input){
       $filteredInput= trim($input);
       $filteredInput= str_replace("'", "", $filteredInput);
       $filteredInput= str_replace('"', "", $filteredInput);
       $filteredInput= str_replace('|', "", $filteredInput);
       return $filteredInput;
   }
   
   function getTableUser($companyPrefix){
       return $this->formatTableName($companyPrefix, AppConstants::$TABLE_USER);
   }
   function getTableProduct($companyPrefix){
       return $this->formatTableName($companyPrefix, AppConstants::$TABLE_PRODUCT);
   }
   function getTableSaleTransaction($companyPrefix){
       return $this->formatTableName($companyPrefix, AppConstants::$TABLE_SALE_TRANSACTION);
   }
   function getTableSaleTransactionDetail($companyPrefix){
       return $this->formatTableName($companyPrefix, AppConstants::$TABLE_SALE_TRANSACTION_DETAIL);
   }
   function getTableStore($companyPrefix){
       return $this->formatTableName($companyPrefix, AppConstants::$TABLE_STORE);
   }

   function getTableCompany(){
       return AppConstants::$TABLE_COMPANY;
   }
   
   function formatTableName($companyPrefix,$tableName){
       if($companyPrefix==""){
           return AppConstants::$DEFAULT_COMPANY_PREFIX."_".$tableName;
       }else{
           return $companyPrefix."_".$tableName;
       }
   }
   
   function getClientTablesList(){
       $clientTables=array(AppConstants::$TABLE_USER,AppConstants::$TABLE_PRODUCT,
       AppConstants::$TABLE_SALE_TRANSACTION,
       AppConstants::$TABLE_SALE_TRANSACTION_DETAIL,
       AppConstants::$TABLE_STORE);
       return $clientTables;
   }
 }
 