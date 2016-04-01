<?php

namespace NewsBundle\Helper;

/**
 * Class StringHelper
 * @package NewsBundle\Helper
 */
class StringHelper
{
    /**
     * @param string $string
     * @return string
     */
    public static function camelize($string)
    {
        return preg_replace_callback('/_(.)/', function ($matches) {
            return strtoupper($matches[1]);
        }, $string);
    }
}
