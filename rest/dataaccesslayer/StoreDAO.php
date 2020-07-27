<?php
include 'DataAccess.php';
include 'CompanyDAO.php';
include '../util/JSONConverter.php';

class StoreDAO{
    function search($storeText,$companyPrefix){
        $dataaccess = new DataAccess();
        $json = new JSONConverter();
        
        $storeText = $dataaccess->sqlInjectionFilter($storeText);
        
        $companyDAO = new CompanyDAO();
        $tableName = $companyDAO->getTableStore($companyPrefix);
        $query ="select * from ".$tableName." where store_id=".$storeText;
        
        //echo $query;
        $result = $dataaccess->getResult($query);
        return $json->jsonEncode($result);
    }
}
?>