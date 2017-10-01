<?php

namespace Saitow\Model;

/**
 * Class Tire
 * @package Saitow\Model
 */
class Tire
{
    /**
     * @var string
     */
    private $dataSource;
    /**
     * @var string
     */
    private $refId;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $image;

    /**
     * @var double
     */
    private $price;

    /**
     * Tire constructor.
     * @param string? $dataSource
     * @param string? $id
     */
    public function __construct($dataSource = '', $id = '')
    {
        $this->dataSource = $dataSource;
        $this->refId = $id;
    }

    /**
     * @return null|string
     */
    public function getId()
    {
        if (!empty($this->refId) && !empty($this->dataSource)) {
            return $this->dataSource . '_' . $this->refId;
        } else {
            return null;
        }
    }

    /**
     * @return string
     */
    public function getDataSource()
    {
        return $this->dataSource;
    }

    /**
     * @return string
     */
    public function getRefId()
    {
        return $this->refId;
    }

    /**
     * @param $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $image
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }
}