<?php
include '../dataaccesslayer/UserDAO.php';
include 'EmailService.php';
class UserService
{
    private $userId=-1;
    function search($companyPrefix,$searchText){
        $userDAO = new UserDAO();
        return $userDAO->search($companyPrefix,$searchText);
    }
    
    function getUserList($companyPrefix){
        $loggedinId = $_SESSION[AppConstants::$LOGIN_ID];
        $userDAO = new UserDAO();
        return $userDAO->getUserList($companyPrefix,$loggedinId);
    }
    
    function add($companyPrefix,$loginId,$storeId,$role,$email,$firstName,$lastName,$password,$phone){
        $userDAO = new UserDAO();
        
        //Step-1: Check If Product Already Exists
        $existingUser = $userDAO->getUserById($companyPrefix,$loginId);
        $existingUser = json_decode($existingUser,true);
        
        if(sizeof($existingUser)>0){
            $existingUser = $existingUser[0];
            $this->userId=$existingUser[AppConstants::$LOGIN_ID];
            $firstName +=$existingUser['firstName'];
            $status = $this->update($companyPrefix,$loginId,$storeId,$role,$email,$firstName,$lastName,$password,$phone);
        }else{
            $status = $userDAO->add($companyPrefix,$loginId,$storeId,$role,$email,$firstName,$lastName,$password,$phone);
            $this->userId=$userDAO->getProductId();
            
            //also create admin account for new companies
            if(isset($_SESSION[AppConstants::$ACTION_ACTIVATED])){
                $loginId=AppConstants::$USER_ADMIN;
                $role=AppConstants::$ROLE_ADMIN;
                $password=$companyPrefix.$loginId;
                $userDAO->add($companyPrefix,$loginId,$storeId,$role,$email,$firstName,$lastName,$password,$phone);
            }
        }
        
        return $status;
    }
    function update($companyPrefix,$loginId,$storeId,$role,$email,$firstName,$lastName,$password,$phone){
        $userDAO = new UserDAO();
        
        $status = $userDAO->update($companyPrefix,$loginId,$storeId,$role,$email,$firstName,$lastName,$password,$phone);
        $this->userId=$loginId;
        
        return $status;
    }
    function lockAccount($companyPrefix,$loginId){
        $userDAO = new UserDAO();
        
        $status = $userDAO->lockAccount($companyPrefix,$loginId);
        $this->userId=$loginId;
        
        return $status;
    }
    function unlockAccount($companyPrefix,$loginId){
        $userDAO = new UserDAO();
        
        $status = $userDAO->unlockAccount($companyPrefix,$loginId);
        $this->userId=$loginId;
        
        return $status;
    }
    function getUserId(){
        return $this->userId;
    }
    
    function forgotPassword($companyPrefix,$loginId,$email){
        $userDAO = new UserDAO();
        $status = $userDAO->getUserCredentials($companyPrefix, $loginId, $email);
        //$status = '{"companyId":"c6ag","companyName":"'.$companyName.'"}';
        if(!strpos($status,'error')){
            $json = new JSONConverter();
            $user = $json->jsonDecode($status);
            if(sizeof($user)>0){
                $user = $user[0];
                //echo $user;
                $emailService = new EmailService();
                $messageTemplate = $emailService->getTemplate('forgotPasswordTemplate');
                $messageTemplate = str_replace("<FIRST_NAME>", $user['firstName'], $messageTemplate);
                $messageTemplate = str_replace("<PASSWORD>", $user['password'], $messageTemplate);
                //echo $messageTemplate;
                $emailService->mail("",$email.",info@bitguiders.com","Forgot your BPOS account password!",$messageTemplate);
                $_SESSION[AppConstants::$ALERT_TYPE_SUCCESS]="Please check your email for login credentials.";
            }else{
                $_SESSION[AppConstants::$ALERT_TYPE_ERROR]="Not a valid loginId or email. Please try again with correct loginId and email.";
            }
            
        }
        return $status;
    }
    
}

