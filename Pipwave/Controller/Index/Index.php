<?php
namespace Dpodium\Pipwave\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $resultJsonFactory;
    protected $information;
    protected $pipwaveIntegration;
    protected $order;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Sales\Model\Order $order,
        \Dpodium\Pipwave\Block\InformationNeeded $information,
        \Dpodium\Pipwave\Model\PipwaveIntegration $pipwaveIntegration
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->order = $order;
        $this->information = $information;
        $this->pipwaveIntegration = $pipwaveIntegration;
    }

    public function execute()
    {
        //run function
        $this->information->prepareData();

        //variables
        $data = $this->information->getDData();

        //get signature param, put into data
        $signatureParam = $this->information->getSignatureParam();
        $data['signature'] = $this->pipwaveIntegration->generatePwSignature($signatureParam);

        $url = $this->information->getUUrl();
        $agent = $this->pipwaveIntegration->getAgent();

        $response = $this->pipwaveIntegration->sendRequestToPw($data, $data['api_key'], $url, $agent);

        $renderUrl = $this->information->getRenderUrl();
        $loadingImageUrl = $this->information->getLoadingImgUrl();
        $callerVersion = $this->information->getVersion();

        //return to Dpodium\Pipwave\view\frontend\web\js\method-renderer\method-renderer.js
        $result = $this->resultJsonFactory->create();
        if ($this->getRequest()->isAjax()) {
            if ($response['status'] == 200) {
                $test = [
                    'loadingImageUrl' => $loadingImageUrl,
                    'apiData'=> json_encode([
                                    'api_key' => $data['api_key'],
                                    'token' => $response['token'],
                                    'caller_version' => $callerVersion
                                ]),
                    'sdkUrl' => $renderUrl,
                    'status' => $response['status']
                ];
            } else {
                $test = [
                    'data' => $data,
                    'status' => $response['status'],
                    'message' => $response['message']
                ];
            }
            $result->setData($test);
            return ($result);
        }
    }
}