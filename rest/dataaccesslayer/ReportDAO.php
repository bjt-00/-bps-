<?php

include 'DataAccess.php';
include '../util/JSONConverter.php';

class ReportDAO {
 
    function getSaleSummary($companyPrefix,$dateFormat){
        $dataaccess = new DataAccess();
        $json = new JSONConverter();
        
        $tableName = $dataaccess->getTableSaleTransaction($companyPrefix);
        $query ='SELECT sum(total_amount) totalAmount,sum(cash_recieved-balance) totalSaleAmount,sum(total_amount-(cash_recieved-balance)) '
            .'totalBalance,date_format(transaction_date_time,"'.$dateFormat.'") date, '
                .'currency '
                    .'FROM '.$tableName.' '
                        .'where date_format(transaction_date_time,"'.$dateFormat.'") = date_format(CURRENT_DATE,"'.$dateFormat.'") '
                            .'group by currency,date_format(transaction_date_time,"'.$dateFormat.'") ';
                            
                            //echo $query;
                            $result = $dataaccess->getResult($query);
                            return $json->jsonEncode($result);
    }
    
    function getDailySaleSummary($companyPrefix){
        return $this->getSaleSummary($companyPrefix,"%M-%d-%Y");
    }
    function getMonthlySaleSummary($companyPrefix){
        return $this->getSaleSummary($companyPrefix,"%M-%Y");
    }
    function getAnnualSaleSummary($companyPrefix){
        return $this->getSaleSummary($companyPrefix,"%Y");
    }
    
    
}
?>