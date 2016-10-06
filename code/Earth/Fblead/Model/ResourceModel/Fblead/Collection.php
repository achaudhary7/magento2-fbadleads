<?php

/**
 * Fblead Resource Collection
 */
namespace Earth\Fblead\Model\ResourceModel\Fblead;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Earth\Fblead\Model\Fblead', 'Earth\Fblead\Model\ResourceModel\Fblead');
    }
}
