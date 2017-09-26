<?php

class Userengage_Userengage_Model_UpdateObserver
{
    public function updateCartAfter($observer)
    {
        $apiKey = Mage::getStoreConfig('userengage/general/apikey');
        if (Mage::getSingleton('customer/session')->isLoggedIn() > 0) {
            $customer  = Mage::getSingleton('customer/session')->getCustomer();
            $custEmail = $customer->getEmail();
        }
        if ($apiKey) {
            $product = Mage::getModel('catalog/product')->load(Mage::app()->getRequest()->getParam('product', 0));
            if (!$product->getId()) {
                return;
            }
            $categories              = $product->getCategoryIds();
            $categories              = $product->getCategoryIds();
            $_cat                    = Mage::getModel('catalog/category')->load($_SESSION["catalog"]["last_viewed_category_id"]);
            $_SESSION["addproduct"]  = 1;
            $_SESSION["productData"] = array(
                'name' => $product->getName(),
                'id' => $product->getId(),
                'quantity' => Mage::app()->getRequest()->getParam('qty', 1),
                'price' => $product->getPrice(),
                'category' => $_cat->getName(),
                'product_url' => $product->getProductUrl(true),
                'image_url' => $product->getImageUrl(),
            );
        }
    }
}