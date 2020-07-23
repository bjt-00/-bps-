<?php
include 'DataAccess.php';
class SecurityDAO{
    
    function login($loginId,$password){
        session_start();
        $dataaccess = new DataAccess();
        
        $loginId = $dataaccess->sqlInjectionFilter($loginId);
        $password = $dataaccess->sqlInjectionFilter($password);
       
        $query="select * from user where user_id='".$loginId."' and password='".$password."'";
        $resultset = $dataaccess->getResult($query);
        
        //check if user is registered
        if($dataaccess->getSize($resultset)<=0){
            $_SESSION['error'] = $loginId." incorrect id or password.";
            return false;
        }
        
        //while($case = mysql_fetch_object($cases)){ 
        $user = mysql_fetch_object($resultset);
        
        //check if user is active
        if($user->is_active){
        $_SESSION['loginId'] = $user->user_id;
        $_SESSION['role'] = $user->role;
        $_SESSION['userName']= $user->first_name." ".$user->last_name;
        $_SESSION['success'] = "Welcome ".$_SESSION['userName'];
        return true;
        }else{
            $_SESSION['error'] = $loginId." is locked. Please reach admin for further assistance.";
            return false;
        }
    }
    
    function logout(){
        session_start();
        $_SESSION['info'] = $_SESSION['userName']." logged out successfully.";
        unset($_SESSION['loginId']);
        unset($_SESSION['role']);
        unset($_SESSION['userName']);
    }
}
?>
