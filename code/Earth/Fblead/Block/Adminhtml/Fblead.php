<?php
/**
 * Adminhtml fblead list block
 *
 */
namespace Earth\Fblead\Block\Adminhtml;

class Fblead extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_fblead';
        $this->_blockGroup = 'Earth_Fblead';
        $this->_headerText = __('Fblead');
        $this->_addButtonLabel = __('Reload Data');
        parent::_construct();
        if ($this->_isAllowedAction('Earth_Fblead::save')) {
            $this->buttonList->update('add', 'label', __('Reload Data'));
        } else {
            $this->buttonList->remove('add');
        }
    }
    
    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
