<?php
class FrontController{
    
    function getUrlByRole($role){
        if($role==ApplicationConstants::$ROLE_ADMIN){
           return "../../dashboard.php";
        } else if($role==ApplicationConstants::$ROLE_SALES_MAN){
            return "../../pos.php";
        }else if($role==ApplicationConstants::$ROLE_GUEST){
            return "../../login.php";
        }
    }
}
?>