<?php
include 'DataAccess.php';
include '../util/JSONConverter.php';

class CompanyDAO{
    function getList(){
        $dataaccess = new DataAccess();
        
        $query = "select company_prefix as companyPrefix"
        .",CASE WHEN is_active=0 THEN CONCAT(company_name,' - [ Inactive ]') "
        ." WHEN is_active=1 THEN CONCAT(company_name,' - [ Trial ]') "
        ."ELSE company_name end companyName"
        ." from company order by company_name";
        
        $resultset = $dataaccess->getResult($query);
        
        $json = new JSONConverter();
        return $json->jsonEncode($resultset);
    }
    
    function update($companyPrefix,$companyId,$companyAddress,$companyPhone){
        $dataaccess = new DataAccess();
        
        $tableCompany = $dataaccess->getTableCompany();
        $companyPrefix = $dataaccess->sqlInjectionFilter($companyPrefix);
        $companyId = $dataaccess->sqlInjectionFilter($companyId);
        $companyAddress = $dataaccess->sqlInjectionFilter($companyAddress);
        $companyPhone = $dataaccess->sqlInjectionFilter($companyPhone);
        
        $query = "update ".$tableCompany." set company_address='".$companyAddress."' , company_phone='".$companyPhone."' "
            ." where company_id='".$companyId."' and company_prefix='".$companyPrefix."'";
        $status = $dataaccess->executeQuery($query);
        
        if($status!=-1){
            $status="Company details updated successfully.";
            $_SESSION[AppConstants::$ALERT_TYPE_SUCCESS]=$status;
        }else {
            $status="Company details couldn't save.";
            $_SESSION[AppConstants::$ALERT_TYPE_ERROR]=$status;
        }
        return $status;
    }
     function getCompanyById($companyId){
        $dataaccess = new DataAccess();
        $companyId = $dataaccess->sqlInjectionFilter($companyId);
        $query = "select company_id as companyId,company_name as companyName, company_address as companyAddress, company_phone as companyPhone,company_email as companyEmail,company_prefix as companyPrefix"
        ." from company where company_id='".$companyId."'";
        $resultset = $dataaccess->getResult($query);
        //echo $query;
        if($dataaccess->getSize($resultset)<=0){
            $_SESSION['error'] = "Not a Registered Company.";
            return false;
        }
        
        $json = new JSONConverter();
        return $json->jsonEncode($resultset);
    }
    function getCompanyId($companyName){
        $dataaccess = new DataAccess();
        $companyId = $dataaccess->sqlInjectionFilter($companyName);
        $query = "select count(*) as companyId FROM company WHERE company_name like '".$companyName."%'";
        //echo $query;
        $resultset = $dataaccess->getResult($query);
        
        if($dataaccess->getSize($resultset)<=0){
            $_SESSION['error'] = "Not a Registered Company.";
            return false;
        }
        
        $json = new JSONConverter();
        $company = $json->jsonEncode($resultset);
        $company = $json->jsonDecode($company);
        
        //echo $company[0]['companyId'];
        return $company[0]['companyId'];
    }
    
    function register($companyName,$companyAddress,$companyPhone,$companyEmail){
        $dataaccess = new DataAccess();
        $companyName = $dataaccess->sqlInjectionFilter($companyName);
        $companyId =$this->getCompanyId($companyName);
        $companyName =($companyId>0?$companyName.'-'.$companyId:$companyName);
       
        $companyId = $this->formatCompanyId($companyId, $companyName);
        $companyPrefix = $companyId;
        $query = "insert into company values('".$companyId."','".$companyName."','".$companyPrefix."','".$companyAddress."','".$companyPhone."','".$companyEmail."','',0)";
        //echo $query;
        $status = $dataaccess->executeQuery($query);
        
        
        if($status==-1 || empty($companyId)){
            $_SESSION['error'] = "Registration Failed.";
            $company = '{"error":"Registration Failed."}';
            return false;
        }else{
            $company = '{"companyId":"'.$companyId.'","companyName":"'.$companyName.'"}';
            $_SESSION['success'] = $companyName." Registred successfully. Please check your email for next step.";
        }
        //echo $company;
        return $company;
    }
    
    function verifyEmail($companyId,$companyEmail,$companyPrefix){
        $dataaccess = new DataAccess();
        $companyId = $dataaccess->sqlInjectionFilter($companyId);
        $companyEmail = $dataaccess->sqlInjectionFilter($companyEmail);
        
        $query = "update company set is_active=1 where "
            ."company_id='".$companyId."' and "
            ."company_email='".$companyEmail."';";
        //echo $query;
        $status = $dataaccess->executeQuery($query);
        
        $this->createCompanyTables($companyPrefix);
        
        if($status!=$companyId){
            $_SESSION['error'] = "Email Verification Failed.";
            $company = '{"error":"Email Verification Failed."}';
        }else{
            $company = '{"companyId":"'.$companyId.'","companyEmail":"'.$companyEmail.'"}';
            $_SESSION['success'] = $companyEmail." Verified successfully. Please check your email for next step.";
        }
        //echo $company;
        return $company;
    }
    
    function formatCompanyId($companyId,$companyName){
        $formattedCompanyId;
        $postFix='';
        if(strpos($companyName,' ')){
            $words = explode(' ',$companyName);
            for($i=0;$i<count($words);$i++){
                $postFix .=substr($words[$i],0,1);
            }
            $postFix = strtolower($postFix);
        }else{
            $postFix=substr($companyName,3,1);
        }
        $formattedCompanyId ='c'.$companyId.$postFix;
        return $formattedCompanyId;
    }
    
    function createCompanyTables($companyPrefix){
        
        $dataaccess = new DataAccess();
        $clientTablesList = $dataaccess->getClientTablesList();
        
        for($i=0;$i<count($clientTablesList);$i++){
            $clientTableName = $dataaccess->formatTableName($companyPrefix, $clientTablesList[$i]);
            $defaultTableName= $dataaccess->formatTableName(AppConstants::$DEFAULT_COMPANY_PREFIX, $clientTablesList[$i]);
            $query ="create table ".$clientTableName." like ".$defaultTableName;
            $dataaccess->executeQuery($query);
        }
    }
    
    function addStore($companyId){
        //Read company details
        $resultset = $this->getCompanyById($companyId);
        $json = new JSONConverter();
        $company = $json->jsonDecode($resultset);
        
        $dataaccess = new DataAccess();
        $tableName = $dataaccess->getTableStore($company[0]['companyPrefix']);
        $query ="insert into ".$tableName." values(NULL, '".$company[0]['companyId']."', '".$company[0]['companyName']."', '".$company[0]['companyAddress']."', '".$company[0]['companyPhone']."', '1')";
        //echo $query;
        $status=$dataaccess->executeQuery($query);
        
        return $status;
        
    }
    

}
?>
