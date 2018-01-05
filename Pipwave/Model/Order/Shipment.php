<?php
namespace Dpodium\Pipwave\Model\Order;

class Shipment extends \Magento\Sales\Model\Order\Shipment
{
    protected $shipmentFactory;
    protected $transactionFactory;
    public function __construct(
        \Magento\Sales\Model\Order\ShipmentFactory $shipmentFactory,
        \Magento\Framework\DB\TransactionFactory $transactionFactory
    ) {
        $this->shipmentFactory = $shipmentFactory;
        $this->transactionFactory = $transactionFactory;
    }

    function createShipment($order, $invoice) {
        try{
            if($invoice) {
                $shipment = $this->prepareShipment($invoice);
            }
            if ($shipment) {
                $order->setIsInProces(true);
                $this->transactionFactory->create()->addObject($shipment)->addObject($shipment->getOrder())->save();
            }
        } catch(\Exception $e) {
            $order->addStatusHistoryComment('Exception message: '.$e->getMessage(), true);
            $order->save();
        }
    }

    function prepareShipment($invoice) {
        $shipment = $this->shipmentFactory->create($invoice->getOrder(), []);
        return $shipment->getTotalQty() ? $shipment->register() : false;
    }
}