<?php

namespace Earth\Fblead\Model\ResourceModel;

/**
 * Fblead Resource Model
 */
class Fblead extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('earth_fblead', 'fblead_id');
    }
}
