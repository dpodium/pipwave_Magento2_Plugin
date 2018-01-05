<?php
namespace Dpodium\Pipwave\Helper;

//constant url
class UrlData {
    //url to fire api [get  from pipwave]
    const URL = 'https://api.pipwave.com/payment';
    const URL_TEST = 'https://staging-api.pipwave.com/payment';

    //url to render sdk [get from pipwave]
    const RENDER_URL = 'https://secure.pipwave.com/sdk/';
    const RENDER_URL_TEST = 'https://staging-checkout.pipwave.com/sdk/';

    //url for loading image [get from pipwave]
    const LOADING_IMAGE_URL = 'https://secure.pipwave.com/images/loading.gif';
    const LOADING_IMAGE_URL_TEST = 'https://staging-checkout.pipwave.com/images/loading.gif';

    //url for controller [get from magento]
    const NOTIFICATION_URL = 'notification/notification/index';

    //if merchant didnt provide, we use default
    const SUCCESS_URL = 'checkout/onepage/success';
    const FAIL_URL = 'checkout/onepage/failure';

    public function getApiUrl($mode) {
        if ($mode == 'yes' || $mode == 1) {
            return self::URL;
        } else {
            return self::URL_TEST;
        }
    }

    public function getRenderUrl($mode) {
        if ($mode == 'yes' || $mode == 1) {
            return self::RENDER_URL;
        } else {
            return self::RENDER_URL_TEST;
        }
    }

    public function getLoadingImgUrl($mode) {
        if ($mode == 'yes' || $mode == 1) {
            return self::LOADING_IMAGE_URL;
        } else {
            return self::LOADING_IMAGE_URL_TEST;
        }
    }

    public function getNotifyUrl($mode) {
        return self::NOTIFICATION_URL;
    }

    public function getSuccessUrl($mode) {
        return self::SUCCESS_URL;
    }

    public function getFailUrl($mode) {
        return self::FAIL_URL;
    }
}