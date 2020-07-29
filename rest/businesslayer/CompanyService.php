<?php
include '../dataaccesslayer/CompanyDAO.php';
class CompanyService
{
    function getList(){
        $companyDAO = new CompanyDAO();
        return $companyDAO->getList();
    }
    
    function getCompanyById($companyId){
        $companyDAO = new CompanyDAO();
        return $companyDAO->getCompanyById($companyId);
    }
}

