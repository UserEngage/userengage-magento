<?php

class Userengage_Userengage_Model_OrderObserver
{
    public function OrderAfter($observer)
    {
        $apiKey = Mage::getStoreConfig('userengage/general/apikey');
        if (Mage::getSingleton('customer/session')->isLoggedIn() > 0) {
            $customer = Mage::getSingleton('customer/session')->getCustomer();
            $user     = $customer->getEmail();
        } else {
            $user = 0;
        }
        if ($apiKey) {
            $data              = '';
            $order             = $observer->getEvent()->getOrder();
            $customer_id       = $order->getCustomerId();
            $customerData      = Mage::getModel('customer/customer')->load($customer_id); // then load customer by customer id
            $_SESSION["order"] = $observer->getEvent()->getOrder()->getId();
            return true;
        }
    }
}