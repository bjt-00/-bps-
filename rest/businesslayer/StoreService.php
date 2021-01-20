<?php
include '../dataaccesslayer/StoreDAO.php';

class StoreService
{
    function search($searchText,$companyPrefix){
        $storeDAO = new StoreDAO();
        return $storeDAO->search($searchText,$companyPrefix);
    }
    
    function add($companyPrefix,$companyId,$storeName,$storeAddress,$storePhone,$isActive){
        $storeDAO = new StoreDAO();
        return $storeDAO->add($companyPrefix,$companyId,$storeName,$storeAddress,$storePhone,$isActive);
    }
    
}

