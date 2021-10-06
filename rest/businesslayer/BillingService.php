<?php
include '../dataaccesslayer/BillingDAO.php';

class BillingService
{
    function search($searchText,$companyPrefix){
        $billingDAO = new BillingDAO();
        if($searchText==AppConstants::$SEARCH_ALL){
            return $billingDAO->getList($companyPrefix);
        }else if($searchText==AppConstants::$BILL_SUMMARY){
        return $billingDAO->getBillSummary($companyPrefix);
        }else if($searchText==AppConstants::$BILL_DUE){
            return $billingDAO->getDueBills($companyPrefix);
        }else {
            return AppConstants::$MESSAGE_BAD_REQUEST;
        }
    }
    function update($companyPrefix,$billId,$paymentTransactionId,$paymentDate){
        $billingDAO = new BillingDAO();
        return $billingDAO->update($companyPrefix,$billId,$paymentTransactionId,$paymentDate);
    }
}

