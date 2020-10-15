<?php

class AppConstants{
    
    static $ROLE_GUEST="Guest";
    static $ROLE_SALES_MAN="Sales Man";
    static $ROLE_ADMIN ="Administrator";
    
    static $COMPANY_PREFIX="companyPrefix";
    static $COMPANY_NAME="companyName";
    static $STORE_ID="storeId";
    static $STORE_ADDRESS="storeAddress";
    static $USER_NAME="userName";
    static $USER_ROLE="role";
    static $LOGIN_ID="loginId";
    
    static $ALERT_TYPE_SUCCESS="success";
    static $ALERT_TYPE_INFO="info";
    static $ALERT_TYPE_ERROR="error";
    
    static $DEFAULT_COMPANY_PREFIX="default";
    static $TABLE_USER="user";
    static $TABLE_PRODUCT="product";
    static $TABLE_SALE_TRANSACTION="sale_transaction";
    static $TABLE_SALE_TRANSACTION_DETAIL="sale_transaction_detail";
    static $TABLE_STORE="store";
    
    static $SEARCH="search";
    static $MESSAGE_FORBIDDEN='{"message":"Request Forbidden"}';
    static $MESSAGE_BAD_REQUEST='{"message":"Bad Request, Check if required params is missing."}';
    
    static $ACTION="action";
    static $ACTION_ADD="Add";
    static $ACTION_UPDATE="Update";
    static $ACTION_DELETE="Delete";
    
    static $REPORT_DAILY_SUMMARY="dailySummary";
    static $REPORT_MONTHLY_SUMMARY="monthlySummary";
    static $REPORT_ANNUAL_SUMMARY="annualSummary";
}
?>