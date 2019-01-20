<?php

namespace App\Kernel\Classes;

class FileService
{
    const LOG_DIR = "./app/Kernel/Data/Logs/"; //TODO move to config
    const STORAGE_DIR = "./app/Kernel/Data/Storage/"; //TODO move to config
    const PROJECT_STORAGE_DIR = "./app/Project/Storage/"; //TODO move to config

    private $file;
    private $filePath;

    public function __construct($fileName, $mode = "r")
    {
        $this->filePath = self::PROJECT_STORAGE_DIR.$fileName;
        if (!file_exists($this->filePath)) {
            $mode = "w+";
        }
        $this->file = @fopen(self::PROJECT_STORAGE_DIR.$fileName, $mode);
    }

    public function get()
    {
        return file_get_contents($this->filePath);
    }

    public function getDes()
    {
        return $this->file;
    }

    public function getPath()
    {
        return $this->filePath;
    }

    public function getName()
    {
        return basename($this->filePath);
    }

    public function show()
    {
        dump(file_get_contents($this->filePath));
    }

    public function put($data)
    {
        file_put_contents($this->filePath, $data);
    }

    public function add($data)
    {
        file_put_contents($this->filePath, $data, FILE_APPEND);
    }

    public function clean()
    {
        ftruncate($this->file, 0);
    }

    public function delete()
    {
        unlink($this->filePath);
    }

    public function trim()
    {
        return file_put_contents($this->filePath, trim($this->get()));
    }

    public function replace($search, $replace)
    {
        return file_put_contents($this->filePath, str_replace($search, $replace, $this->get()));
    }

    public function lock($mode = LOCK_EX)
    {
        flock($this->file, $mode);
    }

    public function unlock()
    {
        fflush($this->file);
        flock($this->file, LOCK_UN);
    }

    public function getPos()
    {
        return ftell($this->file);
    }

    public function setPos($mode = SEEK_SET)
    {
        fseek($this->file, $mode);
    }

    public function isEnd()
    {
        return feof($this->file);
    }

    public function getFrequency()
    {
        $words = preg_split("/[\s,.]+/", $this->get());
        return array_count_values($words);
    }

}