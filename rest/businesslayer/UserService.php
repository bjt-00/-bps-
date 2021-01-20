<?php
include '../dataaccesslayer/UserDAO.php';
class UserService
{
    private $userId=-1;
    function search($companyPrefix,$searchText){
        $userDAO = new UserDAO();
        return $userDAO->search($companyPrefix,$searchText);
    }
    
    function getUserList($companyPrefix){
        $userDAO = new UserDAO();
        return $userDAO->getUserList($companyPrefix);
    }
    
    function add($companyPrefix,$loginId,$storeId,$role,$email,$firstName,$lastName,$password,$phone){
        $userDAO = new UserDAO();
        
        //Step-1: Check If Product Already Exists
        $existingUser = $userDAO->getUserByName($companyPrefix,$loginId);
        $existingUser = json_decode($existingUser,true);
        
        if(sizeof($existingUser)>0){
            $existingUser = $existingUser[0];
            $this->userId=$existingUser['loginId'];
            $firstName +=$existingUser['firstName'];
            $status = $this->update($companyPrefix,$loginId,$storeId,$role,$email,$firstName,$lastName,$password,$phone);
        }else{
            $status = $userDAO->add($companyPrefix,$loginId,$storeId,$role,$email,$firstName,$lastName,$password,$phone);
            $this->userId=$userDAO->getProductId();
            
            //also create admin account for new companies
            if(isset($_SESSION[AppConstants::$ACTION_ACTIVATED])){
                $loginId="admin";
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
}

