<?php


class ML_Homepage_Block_Adminhtml_Homepage_Grid
    extends Mage_Adminhtml_Block_Widget_Grid {
 
    public function __construct(){
        parent::__construct();
        $this->setId('homepageGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection(){
        $collection = Mage::getModel('ml_homepage/homepage')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns(){
        $this->addColumn('entity_id', array(
            'header'    => Mage::helper('ml_homepage')->__('Id'),
            'index'        => 'entity_id',
            'type'        => 'number'
        ));
        $this->addColumn('name', array(
            'header'    => Mage::helper('ml_homepage')->__('Name'),
            'align'     => 'left',
            'index'     => 'name',
        ));
        $this->addExportType('*/*/exportCsv', Mage::helper('ml_homepage')->__('CSV'));
        $this->addExportType('*/*/exportExcel', Mage::helper('ml_homepage')->__('Excel'));
        $this->addExportType('*/*/exportXml', Mage::helper('ml_homepage')->__('XML'));
        return parent::_prepareColumns();
    }

    public function getRowUrl($row){
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    public function getGridUrl(){
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }

    protected function _afterLoadCollection(){
        $this->getCollection()->walk('afterLoad');
        parent::_afterLoadCollection();
    }
}
