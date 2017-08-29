<?php
/**
 * Reviews
 * 
 * @author Slava Yurthev
 */
namespace SY\Reviews\Block\Listing;

class View extends \Magento\Framework\View\Element\Template {
	protected $_registry;
	public function __construct(
			\Magento\Framework\View\Element\Template\Context $context,
			\Magento\Framework\Registry $registry
		){
		$this->_registry = $registry;
		parent::__construct($context);
	}
	public function getItem($key = false){
		if($key){
			return $this->_registry->registry('review')->getData($key);
		}
		return $this->_registry->registry('review');
	}
	protected function _prepareLayout(){
		$this->pageConfig->getTitle()->set($this->getItem('title'));
		$this->getLayout()->getBlock('breadcrumbs')->addCrumb(
				'home',
				[
					'title' => __('Home'),
					'label' => __('Home'),
					'link' => $this->getUrl('')
				]
			)->addCrumb(
				'reviews',
				[
					'title' => __('Reviews'),
					'label' => __('Reviews'),
					'link' => $this->getUrl('reviews')
				]
			);
		parent::_prepareLayout();
	}
}