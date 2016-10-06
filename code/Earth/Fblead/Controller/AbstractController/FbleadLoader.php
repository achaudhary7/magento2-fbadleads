<?php

namespace Earth\Fblead\Controller\AbstractController;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Registry;

class FbleadLoader implements FbleadLoaderInterface
{
    /**
     * @var \Earth\Fblead\Model\FbleadFactory
     */
    protected $fbleadFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $url;

    /**
     * @param \Earth\Fblead\Model\FbleadFactory $fbleadFactory
     * @param OrderViewAuthorizationInterface $orderAuthorization
     * @param Registry $registry
     * @param \Magento\Framework\UrlInterface $url
     */
    public function __construct(
        \Earth\Fblead\Model\FbleadFactory $fbleadFactory,
        Registry $registry,
        \Magento\Framework\UrlInterface $url
    ) {
        $this->fbleadFactory = $fbleadFactory;
        $this->registry = $registry;
        $this->url = $url;
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return bool
     */
    public function load(RequestInterface $request, ResponseInterface $response)
    {
        $id = (int)$request->getParam('id');
        if (!$id) {
            $request->initForward();
            $request->setActionName('noroute');
            $request->setDispatched(false);
            return false;
        }

        $fblead = $this->fbleadFactory->create()->load($id);
        $this->registry->register('current_fblead', $fblead);
        return true;
    }
}
