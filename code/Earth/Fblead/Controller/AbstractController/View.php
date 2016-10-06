<?php

namespace Earth\Fblead\Controller\AbstractController;

use Magento\Framework\App\Action;
use Magento\Framework\View\Result\PageFactory;

abstract class View extends Action\Action
{
    /**
     * @var \Earth\Fblead\Controller\AbstractController\FbleadLoaderInterface
     */
    protected $fbleadLoader;
	
	/**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Action\Context $context
     * @param OrderLoaderInterface $orderLoader
	 * @param PageFactory $resultPageFactory
     */
    public function __construct(Action\Context $context, FbleadLoaderInterface $fbleadLoader, PageFactory $resultPageFactory)
    {
        $this->fbleadLoader = $fbleadLoader;
		$this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Fblead view page
     *
     * @return void
     */
    public function execute()
    {
        if (!$this->fbleadLoader->load($this->_request, $this->_response)) {
            return;
        }

        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
		return $resultPage;
    }
}
