<?php
include '../dataaccesslayer/StoreDAO.php';
class StoreService
{
    function search($searchText,$companyPrefix){
        $storeDAO = new StoreDAO();
        return $storeDAO->search($searchText,$companyPrefix);
    }
}

