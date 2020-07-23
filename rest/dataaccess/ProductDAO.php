<?php
include 'DataAccess.php';
include '../util/JSONConverter.php';

class ProductDAO{
    function search($searchText){
        $dataaccess = new DataAccess();
        $json = new JSONConverter();
        
        $searchText = $dataaccess->sqlInjectionFilter($searchText);
        $query ="select * from product where product_id='".$searchText
        ."' or product_name like '%".$searchText."%' limit 1";
        //echo $query;
        $result = $dataaccess->getResult($query);
        return $json->jsonEncode($result);
    }
    
    function add($recieptDetails,$loginId,$role){
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
        
        $query="INSERT INTO sale_transaction VALUES (NULL, '".$customerId."', 'S1', '".$loginId."', '".$entries."', '".$tax."', '".$totalAmount."', '".$cashRecieved."', '".$balance."', 'PKR', 'store', CURRENT_TIMESTAMP);";
        $transactionId = $dataaccess->executeQuery($query);
        $this->addTransactionDetails($transactionId,$recieptProducts);
        
        return $transactionId;
    }
    
    function addTransactionDetails($transactionId,$recieptProducts){
        
        $dataaccess = new DataAccess();
        for($i=0;$i<sizeof($recieptProducts);$i++){
            $product = $recieptProducts[$i];
            
            $productId = $product['productId'];
            $productQuantity = $product['productQuantity'];
            $totalPrice = $product['totalPrice'];
            $query="INSERT INTO sale_transaction_detail VALUES (NULL, ".$transactionId.",'".$productId."', '".$productQuantity."', '".$totalPrice."');";
            $dataaccess->executeQuery($query);
        }
    }
}
?>