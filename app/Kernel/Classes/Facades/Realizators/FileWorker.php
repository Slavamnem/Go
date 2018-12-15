<?php
namespace App\Kernel\Classes\Facades\Realizators;

class FileWorker
{
    const LOG_DIR = "./app/Kernel/Data/Logs/";
    const STORAGE_DIR = "./app/Kernel/Data/Storage/";

    public function __construct()
    {

    }
    public function save($file, $data)
    {
        $fileDir = implode("/", array_slice(explode("/", self::STORAGE_DIR.$file), 0, -1));

        if (!file_exists($fileDir)){
            mkdir($fileDir);
        }

        file_put_contents(self::STORAGE_DIR.$file, $data,FILE_APPEND);
    }

    public function get($file)
    {
        return file_get_contents(self::STORAGE_DIR.$file);
    }

    public function log($data, $type = "text")
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
}