<?php

namespace Saitow\Library;

use InvalidArgumentException;
use Saitow\Library\TiresStorageManager\TiresDataLoader;
use Saitow\Library\TiresCollectionSorter;

class TiresStorageManager
{
    private $dataSources;

    public function __construct($dataSources)
    {
        $this->dataSources = $dataSources;
    }

    public function getDataSources()
    {
        return $this->dataSources;
    }

    public function query($operation, $args)
    {
        var_dump($args); die();

        $dataLoader = new TiresDataLoader($this);

        switch ($operation) {
            case 'getAll':
                return TiresCollectionSorter::sort($dataLoader->all(), $args);
                break;
            case 'search':
                return TiresCollectionSorter::sort($dataLoader->search(), $args);
                break;
            case 'get':
                return $dataLoader->get($args);
            default:
                throw new InvalidArgumentException();
        }
    }

    public function __call($operation, $args)
    {
        try {
            return $this->query($operation, $args);
        } catch (InvalidArgumentException $e) {
            throw new \BadMethodCallException(sprintf('Undefined operation called: "%s"', $operation));
        }
    }
}
