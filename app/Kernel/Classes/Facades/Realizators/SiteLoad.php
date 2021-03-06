<?php
namespace App\Kernel\Classes\Facades\Realizators;

use App\Kernel\Classes\Facades\Db;
use App\Kernel\Classes\Facades\File;
use App\Kernel\Classes\Request;

class SiteLoad
{
    const REQUESTS_DIR = "./app/Kernel/Data/Requests/";
    const MINUTE_LIMIT = 5;
    const DAY_LIMIT = 10000;

    public $currentLimit;
    public $startTime;

    public function __construct(){
        $this->startTime = date("Y-m-d H:i:s", strtotime("last minute"));
        $this->currentLimit = self::MINUTE_LIMIT;
    }

    public function check(Request $request)
    {
        $frequency = $this->countFrequency($request); dump($frequency);
        $this->rememberRequest($request);

        return $this->currentLimit >= $frequency;
    }

    public function rememberRequest(Request $request)
    {
        File::setRequest(serialize($request));
    }

    public function countFrequency(Request $request)
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

    public function getRequests()
    {
        $requestsFileName = self::REQUESTS_DIR . date("Y.m.d");
        return file($requestsFileName);
    }

    public function overloadResponse()
    {
        dump("Нагрузка на сайт слишком велика. Подождите пару минут.");
    }
}