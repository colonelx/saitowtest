<?php

namespace Saitow\Library\TiresDataSources;

use Saitow\Exceptions\TiresNotFoundException;
use Saitow\Library\TiresDataSource;
use Saitow\Library\TiresDataSourceInterface;
use Saitow\Model\Tire;

/**
 * Class TiresXmlDataSource
 * @package Saitow\Library\TiresDataSources
 */
class TiresXmlDataSource implements TiresDataSourceInterface
{
    private $filePath;

    /**
     * TiresXmlDataSource constructor.
     * @param $filePath
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * {@inheritDoc}
     */
    public function getAll($searchTerm='')
    {
        $results = [];
        $xmlObject = simplexml_load_file($this->filePath);
        if(!empty($searchTerm)) {
            $items = $xmlObject->xpath(
                sprintf(
                    "//tire[contains(manufacturer, '%s') or contains(name,'%s')]",
                    strtoupper($searchTerm),
                    strtoupper($searchTerm)
            ));
        } else {
            $items = $xmlObject->xpath('//tire');
        }

        foreach ($items as $tireRow) {
            $tire = new Tire($this->getDataSourceType(), (int)$tireRow->id);
            $tire->setTitle($tireRow->manufacturer . ' / ' . $tireRow->name);
            $tire->setDescription($tireRow->additional);
            $tire->setImage($tireRow->product_image);
            $tire->setPrice((double)$tireRow->price);

            $results[] = $tire;
        }

        return $results;
    }

    /**
     * {@inheritDoc}
     */
    public function getById($id)
    {
        $xmlObject = simplexml_load_file($this->filePath);

        $item = $xmlObject->xpath(sprintf("//tire[id='%d']", $id))[0];
        if ($item) {
            $tire = new Tire($this->getDataSourceType(), (int)$item->id);
            $tire->setTitle($item->manufacturer . ' / ' . $item->name);
            $tire->setDescription($item->additional);
            $tire->setImage($item->product_image);
            $tire->setPrice((double)$item->price);

            return $tire;
        }
        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function getDataSourceType()
    {
        return TiresDataSource::TYPE_XML;
    }
}
