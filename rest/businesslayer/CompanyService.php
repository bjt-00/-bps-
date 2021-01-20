<?php
include '../dataaccesslayer/CompanyDAO.php';
include 'EmailService.php';

class CompanyService
{
    function getList(){
        $companyDAO = new CompanyDAO();
        return $companyDAO->getList();
    }
    
    function update($companyPrefix,$companyId,$companyAddress,$companyPhone){
        $companyDAO = new CompanyDAO();
        return $companyDAO->update($companyPrefix,$companyId,$companyAddress,$companyPhone);
    }
    function getCompanyById($companyId){
        $companyDAO = new CompanyDAO();
        return $companyDAO->getCompanyById($companyId);
    }
    function register($companyName,$companyAddress,$companyPhone,$companyEmail){
        $companyDAO = new CompanyDAO();
        $status = $companyDAO->register($companyName,$companyAddress,$companyPhone,$companyEmail);
        //$status = '{"companyId":"c6ag","companyName":"'.$companyName.'"}';
        if(!strpos($status,'error')){
            $json = new JSONConverter();
            $company = $json->jsonDecode($status);
            
            $companyActivationCode = base64_encode($company['companyId']."-cac-".$companyEmail);
            
            $emailService = new EmailService();
            $messageTemplate = $emailService->getTemplate('accountActivationTemplate');
            $messageTemplate = str_replace("<COMPANY_NAME>", $company['companyName'], $messageTemplate);
            $messageTemplate = str_replace("<COMPANY_ACTIVATION_CODE>", $companyActivationCode, $messageTemplate);
            $messageTemplate = str_replace("<COMPANY_PHONE>", $companyPhone, $messageTemplate);
            $messageTemplate = str_replace("<COMPANY_EMAIL>", $companyEmail, $messageTemplate);
            $messageTemplate = str_replace("<COMPANY_ADDRESS>", $companyAddress, $messageTemplate);
            //echo $messageTemplate;
            
            $emailService->mail("",$companyEmail.",info@bitguiders.com","Activate your BPOS account now",$messageTemplate);
            
        }
        return $status;
    }
    function extractCompanyId($companyActivationCode){
        $companyActivationCode =base64_decode($companyActivationCode);
        
        $codeChunks = explode("-cac-",$companyActivationCode);
        if(count($codeChunks)==2){
        return $codeChunks[0];
        }else{
            return -1;
        }
    }
    function extractCompanyEmail($companyActivationCode){
        $companyActivationCode =base64_decode($companyActivationCode);
        $codeChunks = explode("-cac-",$companyActivationCode);
        if(count($codeChunks)==2){
            return $codeChunks[1];
        }else{
            return -1;
        }
    }
    function verifyEmail($companyActivationCode){

        //Step-I: extract companyId and email for activation
        $companyId = $this->extractCompanyId($companyActivationCode);
        $companyEmail=$this->extractCompanyEmail($companyActivationCode);
        
        //Step-II: retrieve company form db
        $companyDAO = new CompanyDAO();
        $resultset = $companyDAO->getCompanyById($companyId);
        $json = new JSONConverter();
        $company = $json->jsonDecode($resultset);
        
        //Step-III: verify if this a valid company
        if(count($company)==0 || $company[0]['companyEmail']!=$companyEmail){
            //$_SESSION['info'] = $companyId.'----'.$companyEmail;
            $_SESSION['error'] ="Company is not registered, or link is expired. please reach info@bitguiders.com for assistnce.";
            return false;
        }
        
        $companyPrefix = $company[0]['companyPrefix'];
        //Step-IV: proceed to next step for success message and admin account
        $status = $companyDAO->verifyEmail($companyId,$companyEmail,$companyPrefix);
        //$status="temp";
        if(!strpos($status,'error')){
            //create default store
            $companyDAO->addStore($companyId);
            
            $status = '{"companyId":"'.$companyId.'","companyEmail":"'.$companyEmail.'","companyName":"'.$company[0]['companyName'].'","companyPrefix":"'.$company[0]['companyPrefix'].'"}';
            $company = $json->jsonDecode($status);
            $_SESSION[AppConstants::$ALERT_TYPE_SUCCESS]="Congratulations '".$company['companyName']."' is active now.";
            $_SESSION[AppConstants::$COMPANY_PREFIX]=$company['companyPrefix'];
            $_SESSION[AppConstants::$ACTION_ACTIVATE]=$company['companyPrefix'];
            
            $emailService = new EmailService();
            $messageTemplate = $emailService->getTemplate('accountActivationTemplate');
            $messageTemplate = str_replace("<COMPANY_NAME>", $company['companyName'], $messageTemplate);
            $messageTemplate = str_replace("<COMPANY_ID>", $company['companyId'], $messageTemplate);
            $messageTemplate = str_replace("<COMPANY_PHONE>", '$companyPhone', $messageTemplate);
            $messageTemplate = str_replace("<COMPANY_EMAIL>", $company['companyEmail'], $messageTemplate);
            $messageTemplate = str_replace("<COMPANY_ADDRESS>", '$companyAddress', $messageTemplate);
            //echo $messageTemplate;
            $_SESSION['accountActivationMessage'] = $messageTemplate;
            
            //$emailService->mail("",$companyEmail.",info@bitguiders.com","BPOS ::: [ Company Registration Confirmation ]",$messageTemplate);
            
        }
        return $status;
    }
}

