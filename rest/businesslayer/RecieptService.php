<?php
include '../dataaccesslayer/RecieptDAO.php';
class RecieptService
{
       
    function add($recieptDetails,$loginId,$role,$companyPrefix){
        $recieptDAO = new RecieptDAO();
        return $recieptDAO->add($recieptDetails,$loginId,$role,$companyPrefix);
    }
}

