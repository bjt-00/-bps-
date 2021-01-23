<?php

    include 'DataAccess.php';
    include '../util/JSONConverter.php';
    
    class UserDAO{
        private $userId=-1;
        
        function search($companyPrefix,$searchText){
            $json = new JSONConverter();
            $dataaccess = new DataAccess();
            
            $searchText = $dataaccess->sqlInjectionFilter($searchText);
            $companyPrefix = $dataaccess->sqlInjectionFilter($companyPrefix);
            
            $tableName = $dataaccess->getTableUser($companyPrefix);
            $storeTable = $dataaccess->getTableStore($companyPrefix);
            $query ="select user_id userId,first_name firstName,last_name lastName,
             email ,phone,role,s.store_id storeId,s.store_name storeName, last_login_date lastLoginDate,u.is_active status
             from ".$tableName." u ".
             " left join ".$storeTable." s on s.store_id=u.store_id ".
             " where u.user_id='".$searchText."' limit 1 ";
             //echo $query;
             $result = $dataaccess->getResult($query);
            return $json->jsonEncode($result);
        }

        function getUserById($companyPrefix,$loginId){
             return $this->search($companyPrefix, $loginId);
        }
        function getUserCredentials($companyPrefix,$loginId,$email){
            $json = new JSONConverter();
            $dataaccess = new DataAccess();
            
            $companyPrefix = $dataaccess->sqlInjectionFilter($companyPrefix);
            $loginId = $dataaccess->sqlInjectionFilter($loginId);
            $email = $dataaccess->sqlInjectionFilter($email);
            
            $tableName = $dataaccess->getTableUser($companyPrefix);

            $query ="select user_id as userId,first_name as firstName,last_name as lastName,
             email ,u.is_active as status,u.password "
             ." from ".$tableName." u ".
             " where u.user_id='".$loginId."' and email='".$email."' limit 1 ";
            //echo $query;
            $result = $dataaccess->getResult($query);
            return $json->jsonEncode($result);
        }
        
        function getUserList($companyPrefix,$logedinId){
            $dataaccess = new DataAccess();
            $json = new JSONConverter();
            
            $tableName = $dataaccess->getTableUser($companyPrefix);
            $storeTable = $dataaccess->getTableStore($companyPrefix);
            $query ="select user_id userId,first_name firstName,last_name lastName,
             email ,phone,role,s.store_id storeId,s.store_name storeName, last_login_date lastLoginDate,u.is_active status 
             from ".$tableName." u ".
             "join ".$storeTable." s on s.store_id=u.store_id"
             ." where u.role!='".AppConstants::$ROLE_ADMIN."' and u.user_id!='".$logedinId."'";
             //echo $query;
             $result = $dataaccess->getResult($query);
             return $json->jsonEncode($result);
        }
        
        function add($companyPrefix,$loginId,$storeId,$role,$email,$firstName,$lastName,$password,$phone){
            $status ='';
 
            $dataaccess = new DataAccess();
            $tableName = $dataaccess->getTableUser($companyPrefix);
 
           $query="insert into ".$tableName." values("
           ."'".$loginId."','"
           .$dataaccess->sqlInjectionFilter($storeId)."','"
           .$dataaccess->sqlInjectionFilter($role)."','"
           .$dataaccess->sqlInjectionFilter($email)."','"
           .$dataaccess->sqlInjectionFilter($phone)."','"
           .$dataaccess->sqlInjectionFilter($firstName)."','"
           .$dataaccess->sqlInjectionFilter($lastName)."',"
           ."'".$dataaccess->sqlInjectionFilter($password)."',".
           "current_timestamp,1)";
           
           $this->userId =$loginId;
           $dataaccess->executeQuery($query);
           $status="Griven User saved successfully.";
           //$status =$status.'<br>'.$query;
           //echo $status;
          return $status;
        }
        function update($companyPrefix,$loginId,$storeId,$role,$email,$firstName,$lastName,$password,$phone){
            $status ='';
            
            $dataaccess = new DataAccess();
            $tableName = $dataaccess->getTableUser($companyPrefix);
            $query='';
            
            $query="update ".$tableName." set "
            .($storeId!=""?"store_id='".$dataaccess->sqlInjectionFilter($storeId)."',":"")
            ."email='".$dataaccess->sqlInjectionFilter($email)."',"
            .($role!=""?"role='".$dataaccess->sqlInjectionFilter($role)."',":"")
            ."phone='".$dataaccess->sqlInjectionFilter($phone)."',"
            ."first_name='".$dataaccess->sqlInjectionFilter($firstName)."',"
            ."last_name='".$dataaccess->sqlInjectionFilter($lastName)."'"
            .($password!=""?",password='".$dataaccess->sqlInjectionFilter($password)."'":"")
            ." where user_id='".$dataaccess->sqlInjectionFilter($loginId)."'";
                                        
            $this->userId=$loginId;
            $dataaccess->executeQuery($query);
            $status = "Given changes saved successfully.";
            //$status =$status.'<br>'.$query;
            $_SESSION["info"]=$status;
            return $status;
        }
        function lockAccount($companyPrefix,$loginId){
            $status ='';
            
            $dataaccess = new DataAccess();
            $tableName = $dataaccess->getTableUser($companyPrefix);
            $query='';
            
            $query="update ".$tableName." set "
            ."is_active=0 "
            ." where user_id='".$dataaccess->sqlInjectionFilter($loginId)."'";
                                        
            $this->userId=$loginId;
            $dataaccess->executeQuery($query);
            $status = "Given account locked successfully.";
            //$status =$status.'<br>'.$query;
            $_SESSION["info"]=$status;
            return $status;
        }
        function unlockAccount($companyPrefix,$loginId){
            $status ='';
            
            $dataaccess = new DataAccess();
            $tableName = $dataaccess->getTableUser($companyPrefix);
            $query='';
            
            $query="update ".$tableName." set "
                ."is_active=1 "
                    ." where user_id='".$dataaccess->sqlInjectionFilter($loginId)."'";
                    
                    $this->userId=$loginId;
                    $dataaccess->executeQuery($query);
                    $status = "Given account unlocked successfully.";
                    //$status =$status.'<br>'.$query;
                    $_SESSION["info"]=$status;
                    return $status;
        }
        
        function getUserId(){
            return $this->userId;
        }
    }

?>