<?php
include 'DataAccess.php';
include '../util/JSONConverter.php';

class CompanyDAO{
    function getList(){
        $dataaccess = new DataAccess();
        
        $query = "select company_prefix as companyPrefix,company_name as companyName from company";
        $resultset = $dataaccess->getResult($query);
        
        $json = new JSONConverter();
        return $json->jsonEncode($resultset);
    }
    
     function getCompanyById($companyId){
        $dataaccess = new DataAccess();
        $companyId = $dataaccess->sqlInjectionFilter($companyId);
        $query = "select * from company where company_id='".$companyId."'";
        $resultset = $dataaccess->getResult($query);
        
        if($dataaccess->getSize($resultset)<=0){
            $_SESSION['error'] = "Not a Registered Company.";
            return false;
        }
        
        $company = mysql_fetch_object($resultset);
        return $company;
    }
    
}
?>
