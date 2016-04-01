<?php

namespace NewsBundle\ResponseBuilder;

/**
 * Class NewsBuilder
 * @package NewsBundle\ResponseBuilder
 */
class NewsBuilder
{
    /**
     * @param array $news
     * @return array
     */
    public static function build(array $news = array())
    {
        $result['items'] = array();

        foreach ( $news as $item ) {
            $result['items'][] = array(
                'id'            => $item->getId(),
                'createTime'    => $item->getCreateDateTime()->format("H:i"),
                'preview'       => $item->getPreview(),
                'href'          => $item->getHref(),
                'important'     => $item->isImportant()
            );
        }

        return $result;
    }
}
