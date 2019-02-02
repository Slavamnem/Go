<?php
namespace App\Kernel\Classes;

use App\Kernel\Classes\Facades\Db;
use App\Kernel\Classes\Facades\File;
use App\Kernel\Classes\Request;

class SiteLoad
{
    const REQUESTS_DIR = "./app/Kernel/Data/Requests/";
    const MINUTE_LIMIT = 500;
    const DAY_LIMIT = 10000;

    private $currentLimit;
    private $startTime;

    public function __construct(){
        $this->startTime = date("Y-m-d H:i:s", strtotime("last minute"));
        $this->currentLimit = self::MINUTE_LIMIT;
    }

    // static accessors
    public static function isTooHighLoad(Request $request){
        $siteLoad = new self();
        return !$siteLoad->isNormalLoad($request);
    }

    public static function overloadResponse(){
        $siteLoad = new self();
        $siteLoad->overload();
    }
    // end section

    public function isNormalLoad(Request $request)
    {
        $frequency = $this->countFrequency($request); dump($frequency);
        $this->rememberRequest($request);

        return $this->currentLimit >= $frequency;
    }

    public function overload()
    {
        dump("Нагрузка на сайт слишком велика. Подождите пару минут.");
    }

    private function rememberRequest(Request $request)
    {
        File::setRequest(serialize($request));
    }

    private function countFrequency(Request $request)
    {
        $total = 0;
        foreach ($this->getRequests() as $currentRequest) {
            if (!empty($currentRequest)) {
                preg_match("/\[(.*?)\]/is", $currentRequest, $matches);
                $requestTime = @$matches[1];

                if (!empty($requestTime)) {
                    $currentRequest = unserialize(substr($currentRequest, strpos($currentRequest, "]:") + 3));
                    $total += ($currentRequest == $request and $requestTime > $this->startTime);
                }
            }
        }
        return $total;
    }

    private function getRequests()
    {
        $requestsFileName = self::REQUESTS_DIR . date("Y.m.d");
        $requests = file($requestsFileName);
        return $requests?? [];
    }

}