<?php
include 'DataAccess.php';
//include 'CompanyDAO.php';
include '../util/JSONConverter.php';

class RecieptDAO{
     
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
        
        
        $tableName = $dataaccess->getTableSaleTransaction($companyPrefix);
        
        $query="INSERT INTO ".$tableName." VALUES (NULL, '".$customerId."', 'S1', '".$loginId."', '".$entries."', '".$tax."', '".$totalAmount."', '".$cashRecieved."', '".$balance."', 'PKR', 'store', CURRENT_TIMESTAMP);";
        $transactionId = $dataaccess->executeQuery($query);
        $this->addTransactionDetails($transactionId,$recieptProducts,$companyPrefix);
        
        return $transactionId;
    }
    
    function addTransactionDetails($transactionId,$recieptProducts,$companyPrefix){
        
        $dataaccess = new DataAccess();
        $tableName = $dataaccess->getTableSaleTransactionDetail($companyPrefix);
        $productTable = $dataaccess->getTableProduct($companyPrefix);
        
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