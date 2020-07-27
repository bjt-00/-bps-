<?php
include '../dataaccesslayer/ProductDAO.php';
class ProductService
{
    function search($searchText,$companyPrefix){
        $productDAO = new ProductDAO();
        return $productDAO->search($searchText,$companyPrefix);
    }
    
    function add($recieptDetails,$loginId,$role,$companyPrefix){
        $productDAO = new ProductDAO();
        $productDAO->add($recieptDetails,$loginId,$role,$companyPrefix);
    }
}

