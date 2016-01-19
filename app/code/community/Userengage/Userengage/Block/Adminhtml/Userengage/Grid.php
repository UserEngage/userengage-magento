<?php

class Userengage_Userengage_Block_Adminhtml_Userengage_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setSaveParametersInSession(true);
  }
}
