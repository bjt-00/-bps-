<?php
include '../dataaccesslayer/ProductDAO.php';
class ProductService
{
    private $productId=-1;
    function search($companyPrefix,$searchText){
        $productDAO = new ProductDAO();
        return $productDAO->search($companyPrefix,$searchText);
    }
    
    function getProductList($companyPrefix){
        $productDAO = new ProductDAO();
        return $productDAO->getProductList($companyPrefix);
    }
    
    function add($companyPrefix,$productId,$productName,$noOfItems,$purchasePrice,$salePrice,$size){
        $productDAO = new ProductDAO();
        
        //Step-1: Check If Product Already Exists
        $existingProduct = $productDAO->getProductByName($companyPrefix,$productId);
        $existingProduct = json_decode($existingProduct,true);
        
        if(sizeof($existingProduct)>0){
            $existingProduct = $existingProduct[0];
            $this->productId=$existingProduct['productId'];
            $noOfItems +=$existingProduct['totalInStock'];
            $status = $this->update($companyPrefix,$this->productId,$productName,$noOfItems,$purchasePrice,$salePrice,$size);
        }else{
            $status = $productDAO->add($companyPrefix,$productId,$productName,$noOfItems,$purchasePrice,$salePrice,$size);
            $this->productId=$productDAO->getProductId();
        }
        
        return $status;
    }
    function update($companyPrefix,$productId,$productName,$noOfItems,$purchasePrice,$salePrice,$size){
        $productDAO = new ProductDAO();
        
        $status = $productDAO->update($companyPrefix,$productId,$productName,$noOfItems,$purchasePrice,$salePrice,$size);
        $this->productId=$productId;
        
        return $status;
    }
    function getProductId(){
        return $this->productId;
    }
}

