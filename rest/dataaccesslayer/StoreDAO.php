<?php

include 'DataAccess.php';
include '../util/JSONConverter.php';

class StoreDAO {
    function search($storeText,$companyPrefix){
        $dataaccess = new DataAccess();
        $json = new JSONConverter();
        
        $storeText = $dataaccess->sqlInjectionFilter($storeText);
        
        $tableName = $dataaccess->getTableStore($companyPrefix);
        $query ="select store_id as storeId,store_address storeAddress,store_phone storePhone,
         is_active isActive 
         from ".$tableName." where store_id=".$storeText;
        
        //echo $query;
        $result = $dataaccess->getResult($query);
        return $json->jsonEncode($result);
    }
    
    function add($companyPrefix,$companyId,$storeName,$storeAddress,$storePhone,$isActive){
        $dataaccess = new DataAccess();
        $tableName = $dataaccess->getTableStore($companyPrefix);
        $query ="insert into ".$tableName." values(NULL, '".$companyId."', '".$storeName."', '".$storeAddress."', '".$storePhone."', '".$isActive."')";
        //echo $query;
        $status=$dataaccess->executeQuery($query);
        
        return $status;
    }
}
?>