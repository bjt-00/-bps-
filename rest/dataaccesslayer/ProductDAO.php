<?php

    include 'DataAccess.php';
    include '../util/JSONConverter.php';
    
    class ProductDAO{
        private $productId=-1;
        
        function search($companyPrefix,$searchText){
            $json = new JSONConverter();
            $dataaccess = new DataAccess();
            
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

        function getProductByName($companyPrefix,$productName){
            $json = new JSONConverter();
            $dataaccess = new DataAccess();
            
            $productName = $dataaccess->sqlInjectionFilter($productName);
            
            $tableName = $dataaccess->getTableProduct($companyPrefix);
            $query ="select product_id productId,product_name productName,total_in_stock totalInStock,
             total_sold totalSold,purchase_price purchasePrice, sale_price salePrice,size
             from ".$tableName." where product_id='".$productName
             ."' or lower(product_name) =lower('".$productName."') limit 1";
             //echo $query;
             $result = $dataaccess->getResult($query);
             return $json->jsonEncode($result);
        }
        
        function getProductList($companyPrefix){
            $dataaccess = new DataAccess();
            $json = new JSONConverter();
            
            $tableName = $dataaccess->getTableProduct($companyPrefix);
            $query ="select product_id productId,product_name productName,total_in_stock totalInStock,
             total_sold totalSold,purchase_price purchasePrice, sale_price salePrice,size
             from ".$tableName;
            
             $result = $dataaccess->getResult($query);
             return $json->jsonEncode($result);
        }
        
        function add($companyPrefix,$productId,$productName,$noOfItems,$purchasePrice,$salePrice,$size){
            $status ='';
            $productId = (null==$productId?'':$productId);
            $productId = (''==$productId?$productName:$productId);

            $dataaccess = new DataAccess();
            $tableName = $dataaccess->getTableProduct($companyPrefix);
            
           $query="insert into ".$tableName." values("
           ."'".$dataaccess->sqlInjectionFilter($productId)."','"
           .$dataaccess->sqlInjectionFilter($productName)."',"
           .$dataaccess->sqlInjectionFilter($noOfItems).","
           ."0,"//totalSold
           .$dataaccess->sqlInjectionFilter($purchasePrice).","
           .$dataaccess->sqlInjectionFilter($salePrice).","
           ."'".$dataaccess->sqlInjectionFilter($size)."')";
           $this->productId =$dataaccess->executeQuery($query);
           if($this->productId==0){
               $this->productId=$productId;
           }
           $status="Griven product saved successfully.";
           //$status =$status.'<br>'.$query;
            
          return $status;
        }
        function update($companyPrefix,$productId,$productName,$noOfItems,$purchasePrice,$salePrice,$size){
            $status ='';
            $productId = (null==$productId?'':$productId);
            $productId = (''==$productId?$productName:$productId);
            
            $dataaccess = new DataAccess();
            $tableName = $dataaccess->getTableProduct($companyPrefix);
            $query='';
            
            $query="update ".$tableName." set "
            ."total_in_stock=".$dataaccess->sqlInjectionFilter($noOfItems).","
            ."purchase_price=".$dataaccess->sqlInjectionFilter($purchasePrice).","
            ."sale_price=".$dataaccess->sqlInjectionFilter($salePrice).","
            ."size='".$dataaccess->sqlInjectionFilter($size)."',"
            ."product_name='".$dataaccess->sqlInjectionFilter($productName)."'"
            ." where product_id='".$dataaccess->sqlInjectionFilter($productId)."'";
                                        
            $this->productId=$productId;
            $dataaccess->executeQuery($query);
            $status = "Given Product changes saved successfully.";
            //$status =$status.'<br>'.$query;
            $_SESSION["info"]=$status;
            return $status;
        }
        
        function getProductId(){
            return $this->productId;
        }
    }

?>