<?php
/**
 * Created by PhpStorm.
 * User: claretyoung
 * Date: 26/01/2018
 * Time: 18:07
 */

namespace Toptal\Blog\Observer\CreateBlog;

use \Psr\Log\LoggerInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;


class Created implements ObserverInterface
{

    protected $logger;


    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $blog = $observer->getBlog();
        //print_r($customer->getData());exit;

        $this->logger->warn('Blog title:' . $blog);
    }
}