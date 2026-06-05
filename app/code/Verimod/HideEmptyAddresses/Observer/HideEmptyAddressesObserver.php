<?php
/**
 * Observer to hide empty address blocks on customer dashboard
 */

namespace Verimod\HideEmptyAddresses\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Psr\Log\LoggerInterface;

class HideEmptyAddressesObserver implements ObserverInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Constructor
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Execute observer
     *
     * @param Observer $observer
     * @return $this
     */
    public function execute(Observer $observer)
    {
        try {
            $layout = $observer->getEvent()->getLayout();
            $block = $layout->getBlock('customer-dashboard-addresses');
            
            if ($block && $block->getTemplate()) {
                $defaultBillingAddress = $block->getDefaultBillingAddress();
                $defaultShippingAddress = $block->getDefaultShippingAddress();
                
                // Her iki adres de boş ise bloğu tamamen gizle
                if (!$defaultBillingAddress && !$defaultShippingAddress) {
                    $block->setData('_is_hidden', true);
                }
            }
        } catch (\Exception $e) {
            $this->logger->error('HideEmptyAddresses Observer Error: ' . $e->getMessage());
        }
        
        return $this;
    }
}