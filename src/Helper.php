<?php

namespace Pro911\PhpUtil;

use InvalidArgumentException;
use function function_exists;
use function is_array;
use function is_object;
use function is_string;

class Helper
{
    public static function call($callable, ...$args)
    {
        //如果是对象，或者是字符串并且是已有函数的方法名
        if (is_object($callable) || (is_string($callable) && function_exists($callable))) {
            return $callable(...$args);
        } elseif (is_array($callable)) {
            list($object, $method) = $callable;
            return is_object($object) ? $object->$method(...$args) : $object::$method(...$args);
        } else {
            throw new InvalidArgumentException("Call Error!");
        }
    }
}