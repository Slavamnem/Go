<?php
namespace App\Kernel\Classes;

class ArrayHelper
{
    public static function isMatch($arr1, $arr2, $obj = null, $comparator = null)
    {
        if (count($arr1) == count($arr2)) {
            for ($i = 0; $i < count($arr1); $i++) {
                if ($obj and $comparator) {
                    if (!$obj->$comparator($arr1[$i], $arr2[$i])) {
                        return false;
                    }
                } elseif (!$obj and $comparator) {
                    if (!$comparator($arr1[$i], $arr2[$i])) {
                        return false;
                    }
                } elseif ($arr1[$i] != $arr2[$i]) {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public static function getFields($data, $field)
    {
        $result = [];
        if (is_array($data)) {
            foreach ($data as $item) {
                $result[] = $item[$field];
            }
        } elseif (is_object($data)) {
            foreach ($data as $item) {
                $result[] = $item->$field;
            }
        }

        return $result;
    }
}