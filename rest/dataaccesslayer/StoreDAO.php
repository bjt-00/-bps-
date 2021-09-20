<?php

include 'DataAccess.php';
include '../util/JSONConverter.php';

class StoreDAO {
    private $storeId=-1;
    
    function search($searchText,$companyPrefix){
        $dataaccess = new DataAccess();
        $json = new JSONConverter();
        
        $searchText = $dataaccess->sqlInjectionFilter($searchText);
        
        $tableName = $dataaccess->getTableStore($companyPrefix);
        $query ="select store_id as storeId,store_name as storeName,store_address storeAddress,store_phone storePhone"
         .",tax,tax_type taxType,is_active isActive" 
         ." from ".$tableName." where store_id=".$searchText
         ." or store_name like '%".$searchText."%' limit 1";
        
        //echo $query;
        $result = $dataaccess->getResult($query);
        return $json->jsonEncode($result);
    }

    function getStoreList($companyPrefix){
        $dataaccess = new DataAccess();
        $json = new JSONConverter();
        
        $companyPrefix = $dataaccess->sqlInjectionFilter($companyPrefix);
        
        $tableName = $dataaccess->getTableStore($companyPrefix);
        $tableName2= $dataaccess->getTableUser($companyPrefix);
        
        $query ="select s.company_id as companyId,s.store_id as storeId,store_name as storeName,store_address storeAddress,store_phone storePhone,s.is_active isActive"
        .",tax,tax_type taxType"
        ." ,'Manager' as managerName,'role' as role ,'email' as managerEmail,'000' as managerPhone"
        //." ,concat(u.first_name,' ',u.last_name) managerName,u.role ,u.email managerEmail,u.phone managerPhone"
        ." from ".$tableName." s ";
        //." left join ".$tableName2." u on u.store_id=s.store_id "
        //." where u.role='".AppConstants::$ROLE_SALES_MANAGER."' and u.is_active";
         
         //echo $query;
         $result = $dataaccess->getResult($query);
         return $json->jsonEncode($result);
    }
    
    function add($companyPrefix,$companyId,$storeName,$storeAddress,$storePhone,$tax,$taxType,$isActive){
        $dataaccess = new DataAccess();
        $tableName = $dataaccess->getTableStore($companyPrefix);
        $query ="insert into ".$tableName." values(NULL, '".$companyId."', '".$storeName."', '".$storeAddress."', '".$storePhone."', ".$tax.", '".$taxType."', '".$isActive."')";
        //echo $query;
        $status=$dataaccess->executeQuery($query);
        //$status .=$query;
        return $status;
    }
    function update($companyPrefix,$companyId,$storeId,$storeName,$storeAddress,$storePhone,$tax,$taxType){
        $dataaccess = new DataAccess();
        $tableName = $dataaccess->getTableStore($companyPrefix);
        $query ="update ".$tableName." set store_name='".$storeName."', store_address='".$storeAddress."', store_phone='".$storePhone."', tax=".$tax.", tax_type='".$taxType."'"
        ." where store_id='".$storeId."' and company_id='".$companyId."' ";
        //echo $query;
        $status=$dataaccess->executeQuery($query);
        //$status .=$query;
        return $status;
    }
    
    function lockStore($companyPrefix,$companyId,$storeId){
        $status ='';
        
        $dataaccess = new DataAccess();
        $tableName = $dataaccess->getTableStore($companyPrefix);
        $query='';
        
        $query="update ".$tableName." set "
            ."is_active=0 "
                ." where store_id='".$dataaccess->sqlInjectionFilter($storeId)."' and company_id='".$companyId."'";
                
                $this->storeId=$storeId;
                $dataaccess->executeQuery($query);
                $status = "Given account locked successfully.";
                //$status =$status.'<br>'.$query;
                $_SESSION["info"]=$status;
                return $status;
    }
    function unlockStore($companyPrefix,$companyId,$storeId){
        $status ='';
        
        $dataaccess = new DataAccess();
        $tableName = $dataaccess->getTableStore($companyPrefix);
        $query='';
        
        $query="update ".$tableName." set "
            ."is_active=1 "
                ." where store_id='".$dataaccess->sqlInjectionFilter($storeId)."' and company_id='".$companyId."'";
                
                $this->storeId=$storeId;
                $dataaccess->executeQuery($query);
                $status = "Given account unlocked successfully.";
                //$status =$status.'<br>'.$query;
                $_SESSION["info"]=$status;
                return $status;
    }
    
    function getStoreId(){
        return $this->storeId;
    }
}
?>