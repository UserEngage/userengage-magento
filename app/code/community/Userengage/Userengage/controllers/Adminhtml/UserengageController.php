<?php

class Userengage_Userengage_Adminhtml_UserengageController extends Mage_Adminhtml_Controller_action
{
    public function indexAction() {
        $block = $this->getLayout()->createBlock(
            'Mage_Core_Block_Template',
            'userengage_config',
            array('template' => 'userengage/userengage_config.phtml')
        );

        $this->loadLayout()->getLayout()->getBlock('head')->setTitle($this->__('UserEngage Module'));
        $this->_setActiveMenu('userengage')
            ->_addContent($block)
            ->renderLayout();
    }
    public function postAction() {
        $path = "userengage/general/apikey";
        !isset($_POST['userengage_apikey']) ? $userengage_apikey = '' : $userengage_apikey = $_POST['userengage_apikey'];
        $config_table = Mage::getSingleton('core/resource')->getTableName('core_config_data');
        $read = Mage::getSingleton('core/resource')->getConnection('core_read');
        $query = 'SELECT * FROM ' . $config_table;
        $query .= ' WHERE scope="default" AND scope_id=0 AND path="'.$path.'"';
        $results = $read->fetchAll($query);
        $write = Mage::getSingleton('core/resource')->getConnection('core_write');

        if ($row = array_pop($results)) {
            $license_id = $row['config_id'];
            $query = 'UPDATE ' . $config_table;
            $query .= ' SET value="' . $userengage_apikey . '"';
            $query .= ' WHERE config_id=' . $license_id;
            $write->query($query);
        } else {
            $query = 'INSERT INTO ' . $config_table;
            $query .= ' (scope, scope_id, path, value)';
            $query .= ' VALUES ("default", 0, "'.$path.'", "' . $userengage_apikey . '")';
            $write->query($query);
        }
        Mage::getConfig()->cleanCache();
        Mage::getConfig()->reinit();
        $this->_redirect('*/*/index');
    }
}
