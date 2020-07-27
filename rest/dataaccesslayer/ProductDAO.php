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
    
    function add($recieptDetails,$loginId,$role,$companyPrefix){
        $dataaccess = new DataAccess();
        $recieptDetails = $_POST['recieptDetails'];
        $recieptProducts = $recieptDetails['recieptProducts'];
        
        $entries = $dataaccess->sqlInjectionFilter($recieptDetails['entries']);
        $tax = $dataaccess->sqlInjectionFilter($recieptDetails['tax']);
        $totalAmount = $dataaccess->sqlInjectionFilter($recieptDetails['totalAmount']);
        $cashRecieved = $dataaccess->sqlInjectionFilter($recieptDetails['cashRecieved']);
        $balance = $dataaccess->sqlInjectionFilter($recieptDetails['balance']);
        $cashRecieved=($cashRecieved==''?0:$cashRecieved);
        $customerId=$dataaccess->sqlInjectionFilter($recieptDetails['customerId']);
        
        
        $companyDAO = new CompanyDAO();
        $tableName = $companyDAO->getTableSaleTransaction($companyPrefix);
        
        $query="INSERT INTO ".$tableName." VALUES (NULL, '".$customerId."', 'S1', '".$loginId."', '".$entries."', '".$tax."', '".$totalAmount."', '".$cashRecieved."', '".$balance."', 'PKR', 'store', CURRENT_TIMESTAMP);";
        $transactionId = $dataaccess->executeQuery($query);
        $this->addTransactionDetails($transactionId,$recieptProducts,$companyPrefix);
        
        return $transactionId;
    }
    
    function addTransactionDetails($transactionId,$recieptProducts,$companyPrefix){
        
        $dataaccess = new DataAccess();
        $companyDAO = new CompanyDAO();
        $tableName = $companyDAO->getTableSaleTransactionDetail($companyPrefix);
        $productTable = $companyDAO->getTableProduct($companyPrefix);
        
        for($i=0;$i<sizeof($recieptProducts);$i++){
            $product = $recieptProducts[$i];
            
            $productId = $dataaccess->sqlInjectionFilter($product['productId']);
            $productQuantity = $dataaccess->sqlInjectionFilter($product['productQuantity']);
            $totalPrice = $dataaccess->sqlInjectionFilter($product['totalPrice']);
            
            $query="INSERT INTO ".$tableName." VALUES (NULL, ".$transactionId.",'".$productId."', '".$productQuantity."', '".$totalPrice."');";
            $dataaccess->executeQuery($query);
            
            //update stock
            $query ="update ".$productTable." set total_in_stock=total_in_stock-".$productQuantity.", total_sold=total_sold+".$productQuantity." where product_id='".$productId."'";
            $dataaccess->executeQuery($query);
        }
    }
}
?>