<?php

namespace Toptal\Blog\Controller\Adminhtml\Post;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;

/**
 * Class Index
 * @package Toptal\Blog\Controller\Adminhtml\Post\Index
 */
class Index extends Action
{

    protected $resultPageFactory = false;

    public function __construct(
        Context $context,PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Posts')));

        return $resultPage;
    }
}
