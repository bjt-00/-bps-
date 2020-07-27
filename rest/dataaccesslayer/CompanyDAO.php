<?php
class CompanyDAO{
    
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
    
    function formatTableName($companyPrefix,$tableName){
        if($companyPrefix==""){
            return AppConstants::$DEFAULT_COMPANY_PREFIX."_".$tableName;
        }else{
           return $companyPrefix."_".$tableName;
        }
    }
    
    function getTableUser($companyPrefix){
        return $this->formatTableName($companyPrefix, AppConstants::$TABLE_USER);
    }
    function getTableProduct($companyPrefix){
        return $this->formatTableName($companyPrefix, AppConstants::$TABLE_PRODUCT);
    }
    function getTableSaleTransaction($companyPrefix){
        return $this->formatTableName($companyPrefix, AppConstants::$TABLE_SALE_TRANSACTION);
    }
    function getTableSaleTransactionDetail($companyPrefix){
        return $this->formatTableName($companyPrefix, AppConstants::$TABLE_SALE_TRANSACTION_DETAIL);
    }
    function getTableStore($companyPrefix){
        return $this->formatTableName($companyPrefix, AppConstants::$TABLE_STORE);
    }
    
}
?>
