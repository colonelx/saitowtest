<?php

namespace Saitow\Library;


use Saitow\Exceptions\TiresNotFoundException;
use Slim\Exception\NotFoundException;

class TiresDataLoader
{
    private $dataManager;

    public function __construct($dataManager)
    {
        $this->dataManager = $dataManager;
    }

    public function all($searchTerm = '')
    {
        $tires = [];
        foreach( $this->dataManager->getDataSources() as $tireDataSource ) {
            $tires = array_merge($tires, $tireDataSource->getAll($searchTerm));
        }

        return $tires;
    }

    public function get($dataSourceName, $id)
    {
        $item = null;
        foreach ($this->dataManager->getDataSources() as $dataSource) {
            if ($dataSource->getDataSourceType() == $dataSourceName) {
                $item = $dataSource->getById($id);
            }
        }
        if ($item == null) {
            throw new TiresNotFoundException(
                sprintf("Item (%s) not found in %s data source.", $id, $dataSourceName)
            );
        } else {
            return $item;
        }

    }
}