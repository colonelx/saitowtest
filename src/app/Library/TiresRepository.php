<?php

namespace Saitow\Library;

use Saitow\Exceptions\TiresRepositoryException;

class TiresRepository
{
    private $dataSources;

    public function __construct($dataSources)
    {
        $this->dataSources = $dataSources;
    }

    public function query($operation, $args)
    {
        $dataLoader = new TiresDataLoader($this);

        $searchTerm = (isset($args[0]['searchTerm'])) ? $args[0]['searchTerm'] : '';
        $orderBy = (isset($args[0]['orderBy'])) ? $args[0]['orderBy'] : TiresDataSource::ORDERBY_MANUFACTURE;
        $id = isset($args[0]['refId']) ? $args[0]['refId'] : 0;
        $dataSource = isset($args[0]['dataSource']) ? $args[0]['dataSource'] : '';

        switch ($operation) {
            case 'getAll':
                return TiresCollectionSorter::sort($dataLoader->all($searchTerm), $orderBy);
                break;
            case 'get':
                return $dataLoader->get($dataSource, $id);
            default:
                throw new TiresRepositoryException("No valid method called");
        }
    }

    public function __call($operation, $args)
    {
        try {
            return $this->query($operation, $args);
        } catch (TiresRepositoryException $e) {
            throw new \BadMethodCallException(sprintf('Undefined operation called: "%s"', $operation));
        }
    }

    public function getDataSources()
    {
        return $this->dataSources;
    }
}
