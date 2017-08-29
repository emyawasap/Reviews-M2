<?php
/**
 * Reviews
 * 
 * @author Slava Yurthev
 */
namespace SY\Reviews\Block\Adminhtml\Index\Edit;
 
use Magento\Backend\Block\Widget\Tabs as WidgetTabs;
 
class Tabs extends WidgetTabs{
	protected function _construct(){
		parent::_construct();
		$this->setId('review_edit_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(__('Review'));
	}
	protected function _beforeToHtml(){
		$this->addTab(
			'general_data',
			[
				'label' => __('General'),
				'title' => __('General'),
				'content' => $this->getLayout()->createBlock(
					'SY\Reviews\Block\Adminhtml\Index\Edit\Tab\General'
				)->toHtml(),
				'active' => true
			]
		);
		return parent::_beforeToHtml();
	}
}