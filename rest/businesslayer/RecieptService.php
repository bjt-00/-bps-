<?php
include '../dataaccesslayer/RecieptDAO.php';
class RecieptService
{
       
    function search($companyPrefix,$recieptId){
        $recieptDAO = new RecieptDAO();
        return $recieptDAO->search($companyPrefix,$recieptId);
    }
    function add($recieptDetails,$loginId,$role,$companyPrefix){
        $recieptDAO = new RecieptDAO();
        return $recieptDAO->add($recieptDetails,$loginId,$role,$companyPrefix);
    }
    function update($recieptDetails,$loginId,$role,$companyPrefix){
        $recieptDAO = new RecieptDAO();
        return $recieptDAO->update($recieptDetails,$loginId,$role,$companyPrefix);
    }
}

