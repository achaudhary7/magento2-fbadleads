<?php

namespace Earth\Fblead\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
	/**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) 

    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
	
    /**
     * Check the permission to run it
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Earth_Fblead::fblead_manage');
    }

    /**
     * Fblead List action
     *
     * @return void
     */
    public function execute()
    {

        
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu(
            'Earth_Fblead::fblead_manage'
        )->addBreadcrumb(
            __('Fblead'),
            __('Fblead')
        )->addBreadcrumb(
            __('Manage Fblead'),
            __('Manage Fblead')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('All leads'));

        return $resultPage;
    }
}
