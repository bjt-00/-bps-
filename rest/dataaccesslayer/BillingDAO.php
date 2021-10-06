<?php

include 'DataAccess.php';
include '../util/JSONConverter.php';

class BillingDAO {
    
    function getList($companyPrefix){
        $dataaccess = new DataAccess();
        $json = new JSONConverter();
        
        $tableName = $dataaccess->getTableBill($companyPrefix);
        $query ="SELECT "
             ."bill_id billId, total_bill totalBill,currency"
             .",date_format(due_date,'%m/%d/%Y') dueDate"
             .",date_format(payment_date,'%m/%d/%Y') paymentDate"
             .",payment_status paymentStatus"
             ." FROM ".$tableName;
        //echo $query;
        $result = $dataaccess->getResult($query);
        return $json->jsonEncode($result);
    }
    
    function getBillSummary($companyPrefix){
        
        $this->updateBillSummary($companyPrefix);
        
        $dataaccess = new DataAccess();
        $json = new JSONConverter();
        $dateFormat='%Y-%m';
        $tableName = $dataaccess->getTableBill($companyPrefix);
        $query ='SELECT bill_id billId,total_sale totalSale,currency'
        .",fee_unit feeUnit"
        .',total_bill totalBill'
        .",date_format(due_date,'%m/%d/%Y') dueDate "
        .",date_format(payment_date,'%m/%d/%Y') paymentDate"
        .',payment_status paymentStatus'
        .' FROM '.$tableName
        .' WHERE bill_id=date_format(CURRENT_DATE-INTERVAL 1 MONTH,"'.$dateFormat.'")';

        //echo $query;
        $result = $dataaccess->getResult($query);
        return $json->jsonEncode($result);
    }
    
    function updateBillSummary($companyPrefix){
        $dataaccess = new DataAccess();
        $tableName = $dataaccess->getTableSaleTransaction($companyPrefix);
        $billTable = $dataaccess->getTableBill($companyPrefix);
        $dateFormat="%Y-%m";
        
        //Step-I: clean existing bill calculation
        $query ='DELETE FROM '.$billTable.' WHERE id=date_format(CURRENT_DATE-INTERVAL 1 MONTH,"'.$dateFormat.'") AND payment_status=0';
        $dataaccess->executeQuery($query);
        //echo $query;
        
        //Step-II: Insert new bill
        $query ='INSERT INTO '.$billTable.' ('
            .'SELECT date_format(CURRENT_DATE-INTERVAL 1 MONTH,"'.$dateFormat.'") id ,sum(total_amount) totalSale,currency,concat(round((1/100),2)," %") feeUnit'
            .',round((sum(total_amount)*(1/100)),0) totalBill'
            .',date_format(CURRENT_DATE,"'.$dateFormat.'-05") dueDate'
            .',date_format("1000-01-01","'.$dateFormat.'-%d") paymentDate,"" paymentType'
            .',0 paymentTransactionId,0 paymentStatus'
            .' FROM '.$tableName
            .' WHERE date_format(transaction_date_time,"'.$dateFormat.'") = date_format(CURRENT_DATE-INTERVAL 1 MONTH,"'.$dateFormat.'")'
            .' GROUP BY currency,date_format(transaction_date_time,"'.$dateFormat.'"))';
        $dataaccess->executeQuery($query);
        //echo $query;
    }
    function getDueBills($companyPrefix){
        
        $dataaccess = new DataAccess();
        $json = new JSONConverter();
        
        $tableName = $dataaccess->getTableBill($companyPrefix);
        $query ='SELECT bill_id billId,total_sale totalSale,currency'
        .",fee_unit feeUnit"
        .',total_bill totalBill'
        .',due_date dueDate '
        .',payment_status paymentStatus'
        .' FROM '.$tableName
        .' WHERE payment_status=0';
                            
        //echo $query;
        $result = $dataaccess->getResult($query);
        return $json->jsonEncode($result);
    }
    
    function update($companyPrefix,$billId,$paymentTransactionId,$paymentDate){
        $dataaccess = new DataAccess();
        
        $paymentTransactionId = $dataaccess->sqlInjectionFilter($paymentTransactionId);
        $paymentDate = $dataaccess->sqlInjectionFilter($paymentDate);
        
        $tableName = $dataaccess->getTableBill($companyPrefix);
        $query = "UPDATE ".$tableName
        ." SET payment_status=1"
        ." , payment_transaction_id='".$paymentTransactionId."'"
        ." , payment_date='".$paymentDate."'"
        ." WHERE bill_id='".$billId."' and payment_status=0 ";
        $status = $dataaccess->executeQuery($query);
        
        if($status!=-1){
            $status="Payment details updated successfully.";
            $_SESSION[AppConstants::$ALERT_TYPE_SUCCESS]=$status;
        }else {
            $status="Payment details couldn't save.";
            $_SESSION[AppConstants::$ALERT_TYPE_ERROR]=$status;
        }
        return $status;
    }
}
?>