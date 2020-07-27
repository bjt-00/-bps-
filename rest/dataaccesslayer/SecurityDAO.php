<?php
include 'DataAccess.php';
include 'CompanyDAO.php';
class SecurityDAO{
    
    function login($companyId,$loginId,$password){
        session_start();
        $dataaccess = new DataAccess();
        
        $loginId = $dataaccess->sqlInjectionFilter($loginId);
        $password = $dataaccess->sqlInjectionFilter($password);
       
        $companyDAO = new CompanyDAO();
        $company = $companyDAO->getCompanyById($companyId);
        $companyPrefix = $company->company_prefix;
        $tableName = $companyDAO->getTableUser($companyPrefix);

        $query="select * from ".$tableName." where user_id='".$loginId."' and password='".$password."'";
        $resultset = $dataaccess->getResult($query);
        
        //check if user is registered
        if($dataaccess->getSize($resultset)<=0){
            $_SESSION[AppConstants::$ALERT_TYPE_ERROR] = $loginId." incorrect id or password.";
            return false;
        }
        
        //while($case = mysql_fetch_object($cases)){ 
        $user = mysql_fetch_object($resultset);
        
        //check if user is active
        if($user->is_active){
        $_SESSION[AppConstants::$LOGIN_ID] = $user->user_id;
        $_SESSION[AppConstants::$USER_ROLE] = $user->role;
        $_SESSION[AppConstants::$USER_NAME]= $user->first_name." ".$user->last_name;
        $_SESSION[AppConstants::$STORE_ID]= $user->store_id;
        $_SESSION[AppConstants::$ALERT_TYPE_SUCCESS] = "Welcome ".$_SESSION['userName'];
        $_SESSION[AppConstants::$COMPANY_PREFIX]=$companyPrefix;
        $_SESSION[AppConstants::$COMPANY_NAME]=$company->company_name;
        return true;
        }else{
            $_SESSION[AppConstants::$ALERT_TYPE_ERROR] = $loginId." is locked. Please reach admin for further assistance.";
            return false;
        }
    }
    
    function logout(){
        session_start();
        $_SESSION[AppConstants::$ALERT_TYPE_INFO] = $_SESSION['userName']." logged out successfully.";
        unset($_SESSION[AppConstants::$LOGIN_ID]);
        unset($_SESSION[AppConstants::$USER_ROLE]);
        unset($_SESSION[AppConstants::$USER_NAME]);
        unset($_SESSION[AppConstants::$COMPANY_PREFIX]);
        unset($_SESSION[AppConstants::$COMPANY_NAME]);
    }
    
 }
?>
