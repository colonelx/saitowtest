<?php

namespace Saitow\Library\TiresDataSources;

use Saitow\Exceptions\TiresNotFoundException;
use Saitow\Library\TiresDataSource;
use Saitow\Library\TiresDataSourceInterface;
use Saitow\Model\Tire;

class TiresXmlDataSource implements TiresDataSourceInterface
{
    private $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

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
            $tire = new Tire($this->getDataSourceType(), $tireRow->id);
            $tire->setTitle($tireRow->manufacturer . ' / ' . $tireRow->name);
            $tire->setDescription($tireRow->additional);
            $tire->setImage($tireRow->product_image);
            $tire->setPrice($tireRow->price);

            $results[] = $tire;
        }

        return $results;
    }

    public function getById($id)
    {
        $xmlObject = simplexml_load_file($this->filePath);

        $item = $xmlObject->xpath(sprintf("//tire[id='%d']", $id))[0];
        if ($item) {
            $tire = new Tire($this->getDataSourceType(), $item->id);
            $tire->setTitle($item->manufacturer . ' / ' . $item->name);
            $tire->setDescription($item->additional);
            $tire->setImage($item->product_image);
            $tire->setPrice($item->price);

            return $tire;
        }
        return null;
    }

    public function getDataSourceType()
    {
        return TiresDataSource::TYPE_XML;
    }
}
