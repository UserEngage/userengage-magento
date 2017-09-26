<?php

class Userengage_Userengage_Model_Observer
{
    public function customerRegisterSuccess(Varien_Event_Observer $observer)
    {
        $apiKey = Mage::getStoreConfig('userengage/general/apikey');
        if ($apiKey) {
            $event          = $observer->getEvent();
            $customer       = $event->getCustomer();
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