<?php

namespace Earth\Fblead\Controller\AbstractController;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;

interface FbleadLoaderInterface
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return \Earth\Fblead\Model\Fblead
     */
    public function load(RequestInterface $request, ResponseInterface $response);
}
