<?php
namespace Dpodium\Pipwave\Model;

use \Magento\Payment\Model\Method\AbstractMethod;

class Url extends AbstractMethod
{
    protected $urlBuilder;
    protected $UrlHelper;
    
    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder,
        \Dpodium\Pipwave\Helper\UrlData $UrlHelper
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->UrlHelper = $UrlHelper;
    }

    function getUrl($test_mode) {
        $url = $this->UrlHelper->getApiUrl($test_mode);
        return $url;
    }

    function getRenderUrl($test_mode) {
        $url = $this->UrlHelper->getRenderUrl($test_mode);
        return $url;
    }

    function getLoadingImageUrl($test_mode) {
        $url = $this->UrlHelper->getLoadingImgUrl($test_mode);
        return $url;
    }

    function defaultSuccessPageUrl() {
        $url = $this->UrlHelper->getSuccessUrl();
        return $this->urlBuilder->getUrl($url);
    }

    function defaultFailPageUrl() {
        $url = $this->UrlHelper->getFailUrl();
        $temp = $this->urlBuilder->getUrl($url);
        return $temp;
    }

    function notificationPageUrl() {
        $url = $this->UrlHelper->getNotifyUrl();
        return $this->urlBuilder->getUrl($url);
    }
}