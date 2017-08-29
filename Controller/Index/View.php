<?php
/**
 * Reviews
 * 
 * @author Slava Yurthev
 */
namespace SY\Reviews\Controller\Index;

use Magento\Framework\App\Action\Action;

class View extends Action {
	protected $_coreRegistry = null;
	protected $resultPageFactory;
	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Magento\Framework\Registry $registry
	) {
		$this->resultPageFactory = $resultPageFactory;
		$this->_coreRegistry = $registry;
		parent::__construct($context);
	}
	public function execute() {
		$id = $this->getRequest()->getParam('id');
		$model = $this->_objectManager->create('SY\Reviews\Model\Review');
		$helper = $this->_objectManager->get('SY\Reviews\Helper\Data');
		$storeManager = $this->_objectManager->get('Magento\Store\Model\StoreManagerInterface');
		if($id && $helper->getConfigValue('general/active', $storeManager->getStore()->getData('store_id')) == "1"){
			$model->load($id);
			if(!$model->getId()){
				$this->_forward('index', 'noroute', 'cms');
			}
			else{
				$this->_coreRegistry->register('review', $model);
				return $this->resultFactory->create(
						\Magento\Framework\Controller\ResultFactory::TYPE_PAGE
					);
			}
		}
		else{
			$this->_forward('index', 'noroute', 'cms');
		}
	}
}