<?php

class ML_Homepage_Adminhtml_Homepage_HomepageController
    extends ML_Homepage_Controller_Adminhtml_Homepage {

    protected function _initHomepage(){
        $homepageId  = (int) $this->getRequest()->getParam('id');
        $homepage    = Mage::getModel('ml_homepage/homepage');
        if ($homepageId) {
            $homepage->load($homepageId);
        }
        Mage::register('current_homepage', $homepage);
        return $homepage;
    }

    public function indexAction() {
        $this->loadLayout();
        $this->_title(Mage::helper('ml_homepage')->__('Homepage Manager'))
             ->_title(Mage::helper('ml_homepage')->__('Home Pages'));
        $this->renderLayout();
    }

    public function gridAction() {
        $this->loadLayout()->renderLayout();
    }

    public function editAction() {
        $homepageId    = $this->getRequest()->getParam('id');
        $homepage      = $this->_initHomepage();
        if ($homepageId && !$homepage->getId()) {
            $this->_getSession()->addError(Mage::helper('ml_homepage')->__('This home page no longer exists.'));
            $this->_redirect('*/*/');
            return;
        }
        $data = Mage::getSingleton('adminhtml/session')->getHomepageData(true);
        if (!empty($data)) {
            $homepage->setData($data);
        }
        Mage::register('homepage_data', $homepage);
        $this->loadLayout();
        $this->_title(Mage::helper('ml_homepage')->__('Homepage Manager'))
             ->_title(Mage::helper('ml_homepage')->__('Home Pages'));
        if ($homepage->getId()){
            $this->_title($homepage->getName());
        }
        else{
            $this->_title(Mage::helper('ml_homepage')->__('Add home page'));
        }
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
        $this->renderLayout();
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function saveAction() {
        if ($data = $this->getRequest()->getPost('homepage')) {
            try {
                $homepage = $this->_initHomepage();
                $homepage->addData($data);
                $mainImageName = $this->_uploadAndGetName('main_image', Mage::helper('ml_homepage/homepage_image')->getImageBaseDir(), $data);
                $homepage->setData('main_image', $mainImageName);
                $homepage->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('ml_homepage')->__('Home Page was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $homepage->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            }
            catch (Mage_Core_Exception $e){
                if (isset($data['main_image']['value'])){
                    $data['main_image'] = $data['main_image']['value'];
                }
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setHomepageData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
            catch (Exception $e) {
                Mage::logException($e);
                if (isset($data['main_image']['value'])){
                    $data['main_image'] = $data['main_image']['value'];
                }
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('ml_homepage')->__('There was a problem saving the home page.'));
                Mage::getSingleton('adminhtml/session')->setHomepageData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('ml_homepage')->__('Unable to find home page to save.'));
        $this->_redirect('*/*/');
    }

    public function exportCsvAction(){
        $fileName   = 'homepage.csv';
        $content    = $this->getLayout()->createBlock('ml_homepage/adminhtml_homepage_grid')->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportExcelAction(){
        $fileName   = 'homepage.xls';
        $content    = $this->getLayout()->createBlock('ml_homepage/adminhtml_homepage_grid')->getExcelFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportXmlAction(){
        $fileName   = 'homepage.xml';
        $content    = $this->getLayout()->createBlock('ml_homepage/adminhtml_homepage_grid')->getXml();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    protected function _isAllowed() {
        return Mage::getSingleton('admin/session')->isAllowed('cms/ml_homepage/homepage');
    }
}
