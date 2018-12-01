<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.11.2018
 * Time: 0:59
 */
namespace App\Kernel\Classes\Interfaces;

interface ModelInterface{
    public function find($data);
    public function get($keys);
    public function save();
    public function update();
    public function delete();
}