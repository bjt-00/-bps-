<?php
include 'DataAccess.php';
class SecurityDAO{
    
    function login($companyPrefix,$loginId,$password){
        session_start();
        $dataaccess = new DataAccess();
        
        $loginId = $dataaccess->sqlInjectionFilter($loginId);
        $password = $dataaccess->sqlInjectionFilter($password);
        $companyPrefix = $dataaccess->sqlInjectionFilter($companyPrefix);
        
        $tableName = $dataaccess->getTableUser($companyPrefix);
        $tableStore = $dataaccess->getTableStore($companyPrefix);
        $tableCompany=$dataaccess->getTableCompany();
        
        $query="select u.user_id as userId,u.role,u.first_name as firstName,u.last_name as lastName"
            .",u.store_id as storeId "
            .",CASE WHEN c.is_active=0 THEN CONCAT(c.company_name,' - [ Inactive ]') "
            ." WHEN c.is_active=1 THEN CONCAT(c.company_name,' - [ Trial ]') "
            ."ELSE c.company_name end companyName"
            .",CASE WHEN u.is_active and s.is_active and c.is_active>0 THEN true "
            ."ELSE false end isActive"
            .",u.is_active as isUserActive"
            .",s.is_active as isStoreActive"
            .",c.is_active as isCompanyActive"
            ." from ".$tableName." u "
            ." join ".$tableStore." s on s.store_id=u.store_id "
            ." join ".$tableCompany." c on c.company_id=s.company_id "
            ." where user_id='".$loginId."' and password='".$password."' ";
        $resultset = $dataaccess->getResult($query);
        //echo $query;
        //check if user is registered
        if($dataaccess->getSize($resultset)<=0){
            $_SESSION[AppConstants::$ALERT_TYPE_ERROR] = $loginId." incorrect id or password.";
            return false;
        }
        
        //while($case = mysql_fetch_object($cases)){ 
        $user = mysql_fetch_object($resultset);
        
        //check if user is active
        if($user->isActive){
        $_SESSION[AppConstants::$LOGIN_ID] = $user->userId;
        $_SESSION[AppConstants::$USER_ROLE] = $user->role;
        $_SESSION[AppConstants::$USER_NAME]= $user->firstName." ".$user->lastName;
        $_SESSION[AppConstants::$STORE_ID]= $user->storeId;
        $_SESSION[AppConstants::$ALERT_TYPE_SUCCESS] = "Welcome ".$_SESSION['userName'];
        $_SESSION[AppConstants::$COMPANY_PREFIX]=$companyPrefix;
        $_SESSION[AppConstants::$COMPANY_NAME]=$user->companyName;//$company->company_name;
        return true;
        }else{
            
             if($user->isCompanyActive<1){
                $_SESSION[AppConstants::$ALERT_TYPE_ERROR] = " You'r Company is locked. Please reach BPOS admin (info@bitguiders.com) for further assistance.";
             }else if(!$user->isStoreActive){
                $_SESSION[AppConstants::$ALERT_TYPE_ERROR] = " You'r Store is locked. Please reach your company admin for further assistance.";
            }else if(!$user->isUserActive){
                $_SESSION[AppConstants::$ALERT_TYPE_ERROR] = "You'r account is locked. Please reach your company admin for further assistance.";
            }
            
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
        session_destroy();
    }
    
 }
?>
