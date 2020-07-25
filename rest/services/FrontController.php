<?php
class FrontController{
    
    function getUrlByRole($role){
        if($role==AppConstants::$ROLE_ADMIN){
           return "../../dashboard.php";
        } else if($role==AppConstants::$ROLE_SALES_MAN){
            return "../../pos.php";
        }else if($role==AppConstants::$ROLE_GUEST){
            return "../../login.php";
        }
    }
}
?>