<?php

namespace Earth\Fblead\Model;

/**
 * Fblead Model
 *
 * @method \Earth\Fblead\Model\Resource\Page _getResource()
 * @method \Earth\Fblead\Model\Resource\Page getResource()
 */
class Fblead extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Earth\Fblead\Model\ResourceModel\Fblead');
    }

}
