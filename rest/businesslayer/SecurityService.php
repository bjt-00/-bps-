<?php
include '../dataaccesslayer/SecurityDAO.php';
class SecurityService{
    
    static function isAuthentic(){
        ini_set('session.gc_maxlifetime', 3600);
        session_start();
        return true;
        if(isset($_GET['sid'])){
            session_id($_GET['sid']);
        }
        if(isset($_SESSION['loginId'])){
            header(AppConstants::$LOGIN_ID.":".$_SESSION[AppConstants::$LOGIN_ID]);
            setcookie(AppConstants::$LOGIN_ID, $_SESSION[AppConstants::$LOGIN_ID], NULL, NULL, NULL, NULL, TRUE);
            return true;
        }
        return false;
    }
    
    function login($companyPrefix,$loginId,$password){
        $securityDAO = new SecurityDAO();
        return $securityDAO->login($companyPrefix, $loginId, $password);
    }
    
    function logout(){
        $securityDAO = new SecurityDAO();
        $securityDAO->logout();
    }
}
?>