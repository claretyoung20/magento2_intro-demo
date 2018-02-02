<?php
namespace Webkul\Grid\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\PageFactory;

class AddRow extends Action
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
        $resultPage->getConfig()->getTitle()->prepend((__('Add Post')));

        return $resultPage;
    }
}
