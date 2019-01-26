<?php
namespace App\Kernel\Classes\Facades\Realizators;

use App\Kernel\Traits\Connectable;
use App\Kernel\Classes\Interfaces\ConnectableInterface;

class FileWorker implements ConnectableInterface
{
    use Connectable;

    const LOG_DIR = "./app/Kernel/Data/Logs/";
    const REQUESTS_DIR = "./app/Kernel/Data/Requests/";
    const STORAGE_DIR = "./app/Kernel/Data/Storage/";
    const PROJECT_STORAGE_DIR = "./app/Project/Storage/";

    public function __construct(){}

    public function save($file, $data)
    {
        $fileDir = implode("/", array_slice(explode("/", self::STORAGE_DIR.$file), 0, -1));

        if (!file_exists($fileDir)){
            mkdir($fileDir);
        }

        file_put_contents(self::PROJECT_STORAGE_DIR . $file, $data,FILE_APPEND);
    }

    public function get($file)
    {
        return file_get_contents(self::PROJECT_STORAGE_DIR . $file);
    }

    public function setRequest($data, $type = "text") // TODO in one func
    {
        $requestsFileName = self::REQUESTS_DIR . date("Y.m.d");
        $this->setType($data, $type);
        $this->appendTime($data);
        file_put_contents($requestsFileName, $data.PHP_EOL,FILE_APPEND);
    }

    public function log($data, $type = "text") //TODO in one func
    {
        $logFileName = self::LOG_DIR.date("Y.m.d");
        $this->setType($data, $type);
        $this->appendTime($data);
        file_put_contents($logFileName, $data,FILE_APPEND);
    }

    public function appendTime(&$data)
    {
        $data = date("[Y-m-d H:i:s]: ").$data.PHP_EOL;
    }

    public function setType(&$data, $type)
    {
        switch ($type) {
            case 'json':
            case 'JSON':
                $data = json_encode($data);
                break;
            case 'json_ru':
            case 'JSON_RU':
            case 'RU_JSON':
            case 'ru_json':
                $data = json_encode($data, JSON_UNESCAPED_UNICODE);
                break;
        }
    }

    public static function makeVar($file, $params = [])
    {
        ob_start();
        extract($params);
        require($file);
        return ob_get_clean();
    }

    public function messageReact($args)
    {
        dump("ura!");
    }
}