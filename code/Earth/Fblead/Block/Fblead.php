<?php

namespace Earth\Fblead\Block;

/**
 * Fblead content block
 */
class Fblead extends \Magento\Framework\View\Element\Template
{
    /**
     * Fblead collection
     *
     * @var Earth\Fblead\Model\ResourceModel\Fblead\Collection
     */
    protected $_fbleadCollection = null;
    
    /**
     * Fblead factory
     *
     * @var \Earth\Fblead\Model\FbleadFactory
     */
    protected $_fbleadCollectionFactory;
    
    /** @var \Earth\Fblead\Helper\Data */
    protected $_dataHelper;
    
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Earth\Fblead\Model\ResourceModel\Fblead\CollectionFactory $fbleadCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Earth\Fblead\Model\ResourceModel\Fblead\CollectionFactory $fbleadCollectionFactory,
        \Earth\Fblead\Helper\Data $dataHelper,
        array $data = []
    ) {
        $this->_fbleadCollectionFactory = $fbleadCollectionFactory;
        $this->_dataHelper = $dataHelper;
        parent::__construct(
            $context,
            $data
        );
    }
    
    /**
     * Retrieve fblead collection
     *
     * @return Earth\Fblead\Model\ResourceModel\Fblead\Collection
     */
    protected function _getCollection()
    {
        $collection = $this->_fbleadCollectionFactory->create();
        return $collection;
    }
    
    /**
     * Retrieve prepared fblead collection
     *
     * @return Earth\Fblead\Model\ResourceModel\Fblead\Collection
     */
    public function getCollection()
    {
        if (is_null($this->_fbleadCollection)) {
            $this->_fbleadCollection = $this->_getCollection();
            $this->_fbleadCollection->setCurPage($this->getCurrentPage());
            $this->_fbleadCollection->setPageSize($this->_dataHelper->getFbleadPerPage());
            $this->_fbleadCollection->setOrder('published_at','asc');
        }

        return $this->_fbleadCollection;
    }
    
    /**
     * Fetch the current page for the fblead list
     *
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->getData('current_page') ? $this->getData('current_page') : 1;
    }
    
    /**
     * Return URL to item's view page
     *
     * @param Earth\Fblead\Model\Fblead $fbleadItem
     * @return string
     */
    public function getItemUrl($fbleadItem)
    {
        return $this->getUrl('*/*/view', array('id' => $fbleadItem->getId()));
    }
    
    /**
     * Return URL for resized Fblead Item image
     *
     * @param Earth\Fblead\Model\Fblead $item
     * @param integer $width
     * @return string|false
     */
    public function getImageUrl($item, $width)
    {
        return $this->_dataHelper->resize($item, $width);
    }
    
    /**
     * Get a pager
     *
     * @return string|null
     */
    public function getPager()
    {
        $pager = $this->getChildBlock('fblead_list_pager');
        if ($pager instanceof \Magento\Framework\Object) {
            $fbleadPerPage = $this->_dataHelper->getFbleadPerPage();

            $pager->setAvailableLimit([$fbleadPerPage => $fbleadPerPage]);
            $pager->setTotalNum($this->getCollection()->getSize());
            $pager->setCollection($this->getCollection());
            $pager->setShowPerPage(TRUE);
            $pager->setFrameLength(
                $this->_scopeConfig->getValue(
                    'design/pagination/pagination_frame',
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                )
            )->setJump(
                $this->_scopeConfig->getValue(
                    'design/pagination/pagination_frame_skip',
                    \Magento\Store\Model\ScopeInterface::SCOPE_STORE
                )
            );

            return $pager->toHtml();
        }

        return NULL;
    }
}
