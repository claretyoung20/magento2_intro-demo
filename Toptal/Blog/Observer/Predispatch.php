<?php


namespace Toptal\Blog\Observer;

use \Psr\Log\LoggerInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;


class Predispatch implements ObserverInterface
{

    /*protected $logger;



    public function __construct(LoggerInterface $logger)
    {
        $this->logger = new Logger();
        $this->logger->addWriter(new Stream(BP.'/var/log/test.log'));

    }


    public function execute(Observer $observer)
    {
        $this->logger->debug('acd');
    }*/

    protected $logger;

    /**
     * Predispatch constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $this->logger->warn('Observer Works');
        //exit; un commet this to make sure event works
    }
}