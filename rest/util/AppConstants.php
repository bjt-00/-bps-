<?php

class AppConstants{
    
    
    static $ROLE_GUEST="Guest";
    static $ROLE_NEW_USER="New User";
    static $ROLE_SALES_PERSON="Sales Person";
    static $ROLE_SALES_MANAGER ="Sales Manager";
    static $ROLE_ADMIN ="Administrator";
    
    static $COMPANY_PREFIX="companyPrefix";
    static $COMPANY_ID="companyId";
    static $COMPANY_NAME="companyName";
    static $COMPANY_ACTIVATION_CODE="cac";
    static $STORE_ID="storeId";
    static $STORE_ADDRESS="storeAddress";
    static $USER_NAME="userName";
    static $USER_ROLE="role";
    static $LOGIN_ID="loginId";
    
    static $UPLOAD_PRODUCTS_FOLDER="products";
    static $UPLOAD_USERS_FOLDER="users";
    static $UPLOAD_COMPANY_LOGO="companyLogo";
    
    static $ALERT_TYPE_SUCCESS="success";
    static $ALERT_TYPE_INFO="info";
    static $ALERT_TYPE_ERROR="error";
    
    static $DEFAULT_COMPANY_PREFIX="default";
    static $TABLE_USER="user";
    static $TABLE_PRODUCT="product";
    static $TABLE_SALE_TRANSACTION="sale_transaction";
    static $TABLE_SALE_TRANSACTION_DETAIL="sale_transaction_detail";
    static $TABLE_STORE="store";
    static $TABLE_COMPANY="company";
    
    static $SEARCH="search";
    static $MESSAGE_FORBIDDEN='{"message":"Request Forbidden"}';
    static $MESSAGE_BAD_REQUEST='{"message":"Bad Request, Check if required params is missing."}';
    
    static $ACTION="action";
    static $ACTION_ADD="Add";
    static $ACTION_UPDATE="Update";
    static $ACTION_DELETE="Delete";
    static $ACTION_LOCK="lock";
    static $ACTION_UNLOCK="unlock";
    static $ACTION_ACTIVATE="activate";
    static $ACTION_ACTIVATED="activated";
    
    static $REPORT_DAILY_SUMMARY="dailySummary";
    static $REPORT_MONTHLY_SUMMARY="monthlySummary";
    static $REPORT_ANNUAL_SUMMARY="annualSummary";
    static $REPORT_ANNUAL_SUMMARY_BY_MONTH="annualSummaryByMonth";
}
?>