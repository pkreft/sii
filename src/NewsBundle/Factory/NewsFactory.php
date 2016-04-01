<?php

namespace NewsBundle\Factory;

use NewsBundle\Entity\News;

/**
 * Class NewsFactory
 * @package NewsBundle\Factory
 */
class NewsFactory
{
    /**
     * @return News;
     */
    public static function create()
    {
        $news = new News();
        $news->setCreateDateTime(new \DateTime());

        return $news;
    }
}