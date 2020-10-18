<?php
include '../dataaccesslayer/ReportDAO.php';

class ReportService
{
    function search($searchText,$companyPrefix){
        $reportDAO = new ReportDAO();
        if($searchText==AppConstants::$REPORT_DAILY_SUMMARY){
        return $reportDAO->getDailySaleSummary($companyPrefix);
        }else if($searchText==AppConstants::$REPORT_MONTHLY_SUMMARY){
            return $reportDAO->getMonthlySaleSummary($companyPrefix);
        }else if($searchText==AppConstants::$REPORT_ANNUAL_SUMMARY){
            return $reportDAO->getAnnualSaleSummary($companyPrefix);
        }else if($searchText==AppConstants::$REPORT_ANNUAL_SUMMARY_BY_MONTH){
            return $reportDAO->getAnnualSaleSummaryByMonth($companyPrefix);
        }else {
            return AppConstants::$MESSAGE_BAD_REQUEST;
        }
    }
}

