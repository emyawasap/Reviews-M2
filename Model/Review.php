<?php
/**
 * Reviews
 * 
 * @author Slava Yurthev
 */
namespace SY\Reviews\Model;

use Magento\Framework\Model\AbstractModel;

class Review extends AbstractModel {
	protected $urlInterface;
	protected $_objectManager;
	public function __construct(
		\Magento\Framework\Model\Context $context,
		\Magento\Framework\Registry $registry,
		\Magento\Framework\UrlInterface $urlInterface,
		\Magento\Framework\ObjectManagerInterface $objectmanager
		){
		$this->urlInterface = $urlInterface;
		$this->_objectManager = $objectmanager;
		parent::__construct($context, $registry);
	}
	protected function _construct() {
		$this->_init('SY\Reviews\Model\ResourceModel\Review');
	}
	public function getUrl(){
		return $this->urlInterface->getUrl('reviews/index/view', ['id'=>$this->getData('id')]);
	}
	public function afterDelete(){
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
		$directory = $this->_objectManager->get('\Magento\Framework\Filesystem\DirectoryList');
		$io = $this->_objectManager->get('Magento\Framework\Filesystem\Io\File');
		try {
			$io->rmdir($directory->getRoot().'/media/review/'.$this->getData('id').'/', true);
		} catch (\Exception $e) {}
		parent::afterDelete();
	}
}