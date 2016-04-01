<?php

namespace NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class News
 * @package NewsBundle\Entity
 *
 * @ORM\Table(name="news")
 * @ORM\Entity(repositoryClass="NewsBundle\Repository\NewsRepository")
 */
class News
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"preview"}, updatable=false, separator="-", unique=true)
     * @ORM\Column(type="string")
     */
    private $href;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $preview;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $createDateTime;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    private $important;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @param string $href
     * @return News
     */
    public function setHref($href)
    {
        $this->href = $href;

        return $this;
    }

    /**
     * @return string
     */
    public function getPreview()
    {
        return $this->preview;
    }

    /**
     * @param string $preview
     * @return News
     */
    public function setPreview($preview)
    {
        $this->preview = $preview;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreateDateTime()
    {
        return $this->createDateTime;
    }

    /**
     * @param \DateTime $createDateTime
     * @return News
     */
    public function setCreateDateTime($createDateTime)
    {
        $this->createDateTime = $createDateTime;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return News
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isImportant()
    {
        return $this->important;
    }

    /**
     * @param boolean $important
     * @return News
     */
    public function setImportant($important)
    {
        $this->important = $important;

        return $this;
    }
}
