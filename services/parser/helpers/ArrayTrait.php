<?php
namespace app\services\parser\helpers;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;

trait ArrayTrait {

    protected $needleArr = [];

    public function getFieldForKeys(array $array, array $keys) : array {
        $arrayIterator = new RecursiveIteratorIterator(
            new RecursiveArrayIterator($array),
            RecursiveIteratorIterator::SELF_FIRST);

        $tempArr = [];
        foreach ($arrayIterator as $iterationKey => $iterationVal) {
            if(in_array($iterationKey, $keys)){
                if( ! is_array($iterationVal)) {
                    $tempArr[$iterationKey] = $iterationVal;
                }
            }
            if(count($tempArr) == count($keys)){
                $tempValues = array_intersect_key($tempArr, array_flip($keys));
                $this->needleArr[] = $tempValues;
                $tempArr = [];
            }
        }

        return $this->needleArr;
    }
}