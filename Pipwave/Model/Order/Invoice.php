<?php
namespace Dpodium\Pipwave\Model\Order;

class Invoice extends \Magento\Sales\Model\Order\Invoice
{
    public function __construct(
        \Magento\Sales\Model\ResourceModel\Order\Invoice\CollectionFactory $invoiceCollectionFactory,
        \Magento\Sales\Model\Service\InvoiceService $invoiceService,
        \Magento\Framework\DB\TransactionFactory $transactionFactory
    ) {
        $this->invoiceCollectionFactory = $invoiceCollectionFactory;
        $this->invoiceService = $invoiceService;
        $this->transactionFactory = $transactionFactory;
    }
    protected $invoiceCollectionFactory;
    protected $invoiceService;
    protected $transactionFactory;

    function createInvoice($order) {
        try {
            $invoice = $this->invoiceCollectionFactory->create()->addAttributeToFilter('order_id', array('eq' => $order->getId()));
            $invoice = $this->invoiceService->prepareInvoice($order);
            $invoice->setRequestedCaptureCase(\Magento\Sales\Model\Order\Invoice::CAPTURE_ONLINE);
            $invoice->register();
            $invoice->getOrder()->setCustomerNoteNotify(true);
            $invoice->getOrder()->setIsInProcess(true);

            $transactionSave = $this->transactionFactory->create()->addObject($invoice)->addObject($invoice->getOrder());
            $transactionSave->save();
        } catch (\Exception $e) {
            $order->addStatusHistoryComment('Exception message: '.$e->getMessage(), false);
            $order->save();
            return null;
        }
        return $invoice;
    }
}