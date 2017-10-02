<?php

namespace Saitow\Library;

use Saitow\Exceptions\TiresNotFoundException;
use Slim\Exception\NotFoundException;

/**
 * Class TiresDataLoader
 * @package Saitow\Library
 */
class TiresDataLoader
{
    private $dataManager;

    /**
     * TiresDataLoader constructor.
     * @param $dataManager
     */
    public function __construct($dataManager)
    {
        $this->dataManager = $dataManager;
    }

    /**
     * Call the getAll() method of all DataSource providers.
     * @param string $searchTerm
     * @return array
     */
    public function all($searchTerm = '')
    {
        $tires = [];
        foreach( $this->dataManager->getDataSources() as $tireDataSource ) {
            $tires = array_merge($tires, $tireDataSource->getAll($searchTerm));
        }

        return $tires;
    }

    /**
     * Fetches a single record from a given DataSource provider.
     * @param string $dataSourceName - Unique string name of the Data Source provider.
     * @param int $id - refId or ID within the Data Source.
     * @return null/Tire
     * @throws TiresNotFoundException
     */
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