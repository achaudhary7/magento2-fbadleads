<?php 



namespace Earth\Fblead\Controller\Index;

use Earth\News\Controller\NewsInterface;

class Post extends \Magento\Framework\App\Action\Action
{

	protected $_objectManager;
    
    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\ObjectManagerInterface $objectManager) 
    {
        $this->_objectManager = $objectManager;
        parent::__construct($context);    
    }

        public function execute()
        {
             $post = $this->getRequest()->getPostValue();
             if (!empty($post)) 
             {
                    $currenttime = date('Y-m-d H:i:s');
                    $model = $this->_objectManager->create('Earth\Fblead\Model\Fblead');
                    $model->setData('fb_leads_name', $post['fb_leads_name']);
                    $model->setData('fb_leads_email', $post['fb_leads_email']);
                    $model->setData('fb_leads_phone', $post['fb_leads_phone']);
                    $model->setData('fb_leads_ad_id', $post['fb_leads_ad_id']);
                    $model->setData('fb_leads_form_id', $post['fb_leads_form_id']);
                    $model->setData('created_at', $currenttime);
                    $model->save();
                    echo "Data Updated Successfully";
             } 
        } 
}


?>