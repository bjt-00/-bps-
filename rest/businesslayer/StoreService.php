<?php
include '../dataaccesslayer/StoreDAO.php';

class StoreService
{
    function search($searchText,$companyPrefix){
        $storeDAO = new StoreDAO();
        return $storeDAO->search($searchText,$companyPrefix);
    }
    
    function getStoreList($companyPrefix){
        $storeDAO = new StoreDAO();
        return $storeDAO->getStoreList($companyPrefix);
    }
    
    function add($companyPrefix,$companyId,$storeName,$storeAddress,$storePhone,$tax,$taxType,$isActive){
        $storeDAO = new StoreDAO();
        return $storeDAO->add($companyPrefix,$companyId,$storeName,$storeAddress,$storePhone,$tax,$taxType,$isActive);
    }
    
    function update($companyPrefix,$companyId,$storeId,$storeName,$storeAddress,$storePhone,$tax,$taxType){
        $storeDAO = new StoreDAO();
        return $storeDAO->update($companyPrefix,$companyId,$storeId,$storeName,$storeAddress,$storePhone,$tax,$taxType);
    }
    
    function lockStore($companyPrefix,$companyId,$storeId){
        $storeDAO = new StoreDAO();
        return $storeDAO->lockStore($companyPrefix,$companyId,$storeId);
    }
    
    function unlockStore($companyPrefix,$companyId,$storeId){
        $storeDAO = new StoreDAO();
        return $storeDAO->unlockStore($companyPrefix,$companyId,$storeId);
    }
}

