<?php

class Userengage_Userengage_Block_Adminhtml_Userengage extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_userengage';
        $this->_blockGroup = 'userengage';
        $this->_headerText = Mage::helper('userengage')->__('UserEngage Panel');
        parent::__construct();
    }
}
