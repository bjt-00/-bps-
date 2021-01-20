<?php
class FrontController{
    
    function getUrlByRole($role){
        if($role==AppConstants::$ROLE_ADMIN || $role==AppConstants::$ROLE_SALES_MANAGER){
           return "../../dashboard.php";
        } else if($role==AppConstants::$ROLE_SALES_PERSON){
            return "../../pos.php";
        }else if($role==AppConstants::$ROLE_GUEST){
            return "../../login.php";
        }else if($role==AppConstants::$ROLE_NEW_USER){
            return "../../register.php";
        }
    }
}
?>