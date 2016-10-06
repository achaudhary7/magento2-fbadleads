<?php
namespace Earth\Fblead\Block\Adminhtml\Fblead;

/**
 * Adminhtml Fblead grid
 */
class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Earth\Fblead\Model\ResourceModel\Fblead\CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * @var \Earth\Fblead\Model\Fblead
     */
    protected $_fblead;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Earth\Fblead\Model\Fblead $fbleadPage
     * @param \Earth\Fblead\Model\ResourceModel\Fblead\CollectionFactory $collectionFactory
     * @param \Magento\Core\Model\PageLayout\Config\Builder $pageLayoutBuilder
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Earth\Fblead\Model\Fblead $fblead,
        \Earth\Fblead\Model\ResourceModel\Fblead\CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->_collectionFactory = $collectionFactory;
        $this->_fblead = $fblead;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('fbleadGrid');
        $this->setDefaultSort('fblead_id');
        $this->setDefaultDir('DESC');
        $this->setUseAjax(true);
        $this->setSaveParametersInSession(true);
    }

    /**
     * Prepare collection
     *
     * @return \Magento\Backend\Block\Widget\Grid
     */
    protected function _prepareCollection()
    {
        $collection = $this->_collectionFactory->create();
        /* @var $collection \Earth\Fblead\Model\ResourceModel\Fblead\Collection */
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * Prepare columns
     *
     * @return \Magento\Backend\Block\Widget\Grid\Extended
     */
    protected function _prepareColumns()
    {
        $this->addColumn('fblead_id', [
            'header'    => __('ID'),
            'index'     => 'fblead_id',
        ]);
        
        $this->addColumn('name', ['header' => __('Name'), 'index' => 'fb_leads_name']);
        $this->addColumn('email', ['header' => __('Email'), 'index' => 'fb_leads_email']);
        $this->addColumn('phone', ['header' => __('Phone Number'), 'index' => 'fb_leads_phone']);
        $this->addColumn('adid', ['header' => __('Fblead Adv Id'), 'index' => 'fb_leads_ad_id']);
        $this->addColumn('formid', ['header' => __('Fblead Form Id'), 'index' => 'fb_leads_form_id']);

  
        
        $this->addColumn(
            'created_at',
            [
                'header' => __('Created'),
                'index' => 'created_at',
                'type' => 'text',
                'header_css_class' => 'col-date',
                'column_css_class' => 'col-date'
            ]
        );
        
       
        return parent::_prepareColumns();
    }


 protected function _prepareMassaction()
    {
        
        $this->setMassactionIdField('fblead_id'); //Db Fiels id
        $this->getMassactionBlock()->setTemplate('Earth_Fblead::lead/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('lead');


        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('fblead/*/Delete'),
                'confirm' => __('Are you sure?')
            ]
        );

    

     


        return $this;


    }
    /**
     * Row click url
     *
     * @param \Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
        return false;
        //return $this->getUrl('*/*/edit', ['fblead_id' => $row->getId()]);
    }

    /**
     * Get grid url
     *
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', ['_current' => true]);
    }
}
