<?php
include '../dataaccesslayer/ProductDAO.php';
class ProductService
{
    function search($searchText,$companyPrefix){
        $productDAO = new ProductDAO();
        return $productDAO->search($searchText,$companyPrefix);
    }
    
}

