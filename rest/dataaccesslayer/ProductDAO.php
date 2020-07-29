<?php

    include 'DataAccess.php';
    include '../util/JSONConverter.php';
    
    class ProductDAO{
        function search($searchText,$companyPrefix){
            $dataaccess = new DataAccess();
            $json = new JSONConverter();
            
            $searchText = $dataaccess->sqlInjectionFilter($searchText);
            
            $tableName = $dataaccess->getTableProduct($companyPrefix);
            $query ="select product_id productId,product_name productName,total_in_stock totalInStock,
             total_sold totalSold,purchase_price purchasePrice, sale_price salePrice,size 
             from ".$tableName." where product_id='".$searchText
            ."' or product_name like '%".$searchText."%' limit 1";
            //echo $query;
            $result = $dataaccess->getResult($query);
            return $json->jsonEncode($result);
        }
    }

?>