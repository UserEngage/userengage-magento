<?php

class Userengage_Userengage_Model_CheckObserver
{
    public function customerRegistered($observer)
    {
        $apiKey = Mage::getStoreConfig('userengage/general/apikey');
        if ($apiKey) {
            $quote           = $observer->getQuote();
            $checkout_method = $quote->getData();
            $checkout_method = $checkout_method['checkout_method'];
            if ($checkout_method == Mage_Checkout_Model_Type_Onepage::METHOD_REGISTER) {
                $customer       = Mage::getSingleton('customer/session')->getCustomer();
                $id             = $customer->getId();
                $customer       = Mage::getModel('customer/customer')->load($customer->getId());
                $billingAddress = $customer->getPrimaryBillingAddress();
                if ($billingAddress) {
                    $countryId = $billingAddress->getCountryId();
                }
                $_SESSION["userRegistered"] = array(
                    'Uid' => $id,
                    'name' => $customer->getFirstname() . ' ' . $customer->getLastname(),
                    'email' => $customer->getEmail()
                );
            }
        }
    }
}