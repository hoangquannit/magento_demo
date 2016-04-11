<?php

class SM_Blog_Block_Adminhtml_Post_Edit_Tab_Productlist extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('productGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setFilterVisibility(true);
        $this->setPagerVisibility(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $id = $this->getRequest()->getParam('id');
        $idProduct = array();
        if($id != null) {
            $model = Mage::getModel('sm_blog/post')->load($id);
            $idProduct = explode(',',$model->getRelated_product());
        }


        $collection = Mage::getResourceModel('catalog/product_collection')
            ->addAttributeToSelect(array('price','sku','name'));
        if(count($idProduct) > 0) {
//            $collection->addAttributeToFilter('entity_id', array('in' => $idProduct));
        }
//            ->addFieldToFilter('vendor', $this->getRequest()->getParam('id'));
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('entity_id', array(
            'header' => Mage::helper('catalog')->__('ID'),
            'align' =>'left',
            'width' => '10px',
            'index' => 'entity_id',
        ));

        $this->addColumn('name', array(
            'header' => Mage::helper('catalog')->__('Name'),
            'align' =>'left',
            'width' => '100px',
            'index' => 'name',
        ));

        $this->addColumn('price', array(
            'header' => Mage::helper('catalog')->__('Price'),
            'align' => 'left',
            'width' => '150px',
            'index' => 'price',
        ));

        $this->addColumn('sku', array(
            'header' => Mage::helper('catalog')->__('SKU'),
            'align' => 'left',
            'width' => '50px',
            'index' => 'sku',
        ));

        return parent::_prepareColumns();
    }

//    public function getGridUrl()
//    {
//        return $this->getUrl('*/*/gridProduct', array('_current'=>true));
//    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=>true));
    }

    public function getRowUrl($row)
    {
        return $this->getBaseUrl().'admin/catalog_product/edit/id/'.$row->getId().'/key/'.$this->getRequest()->getParam('store');
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('related_product[]');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'=> Mage::helper('catalog')->__(),
//            'url'  => $this->getBaseUrl() . 'admin/catalog_product/massDelete',
//            'confirm' => Mage::helper('catalog')->__('Are you sure?')
        ));
        return $this;
    }

}