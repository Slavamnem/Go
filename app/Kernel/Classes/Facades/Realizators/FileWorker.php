<?php
namespace App\Kernel\Classes\Facades\Realizators;

use App\Kernel\Classes\ArgumentObjects\FileData;
use App\Kernel\Classes\Facades\Db;
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
        file_put_contents(self::PROJECT_STORAGE_DIR . $file, $data,FILE_APPEND);
    }

    public function createDir($dir)
    {
        if (!file_exists($dir)){
            mkdir($dir);
        }
    }

    public function get($file, $isFull = false)
    {
        if ($isFull){
            return file_get_contents($file);
        } else {
            return file_get_contents(self::PROJECT_STORAGE_DIR . $file);
        }
    }

    public function setRequest($data, $type = "text")
    {
        $this->fileWrite(new FileData($data, self::REQUESTS_DIR, $type, FILE_APPEND));
    }

    public function log($data, $type = "text")
    {
        $this->fileWrite(new FileData($data, self::LOG_DIR, $type, FILE_APPEND));
    }

    private function fileWrite(FileData $fileData)
    {
        $fileFullName = $fileData->getStorage() . date("Y.m.d");
        $data = $fileData->getData();
        $this->setType($data, $fileData->getType());
        $this->appendTime($data);
        file_put_contents($fileFullName, $data . PHP_EOL, $fileData->getWriteMode());
    }

    private function appendTime(&$data)
    {
        $data = date("[Y-m-d H:i:s]: ") . $data.PHP_EOL;
    }

    private function setType(&$data, $type) // TODO trash
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

    public function getWithoutExtension($fullName){
        return substr($fullName, 0, strrpos($fullName, "."));
    }

    public function messageReact($args) // TODO remove
    {
        dump("ura!");
    }
}