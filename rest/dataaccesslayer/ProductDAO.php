<?php
include 'DataAccess.php';
include 'CompanyDAO.php';
include '../util/JSONConverter.php';

class ProductDAO{
    function search($searchText,$companyPrefix){
        $dataaccess = new DataAccess();
        $json = new JSONConverter();
        
        $searchText = $dataaccess->sqlInjectionFilter($searchText);
        
        $companyDAO = new CompanyDAO();
        $tableName = $companyDAO->getTableProduct($companyPrefix);
        $query ="select * from ".$tableName." where product_id='".$searchText
        ."' or product_name like '%".$searchText."%' limit 1";
        //echo $query;
        $result = $dataaccess->getResult($query);
        return $json->jsonEncode($result);
    }
}
?>