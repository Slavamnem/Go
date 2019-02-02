<?php

namespace App\Kernel\Classes\ArgumentObjects;

use App\Kernel\Classes\Facades\Config;

class FileData
{
    public $data;
    private $storage;
    private $type;
    private $writeMode;

    public function initialize()
    {
        $this->controllersDir = Config::get("controllers", "controllers-dir");
    }

    public function __construct($data, $storage, $type = "text", $mode = FILE_TEXT)
    {
        $this->data = $data;
        $this->storage = $storage;
        $this->type = $type;
        $this->writeMode = $mode;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getStorage()
    {
        return $this->storage;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getWriteMode()
    {
        return $this->writeMode;
    }
}