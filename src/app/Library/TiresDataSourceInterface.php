<?php

namespace Saitow\Library;

use Saitow\Model\Tire;

/**
 * Interface TiresDataSourceInterface
 * @package Saitow\Library
 */
interface TiresDataSourceInterface
{
    /**
     * Fetches all results that correspond to the searchTerm, if none is provided,
     * then fetches all items from the DataSource
     * @param $searchTerm
     * @return ArrayList<Tire>
     */
    public function getAll($searchTerm);

    /**
     * Fetches a single item
     * @param $id
     * @return Tire
     */
    public function getById($id);

    /**
     * Fetches the unique DataSource Type name
     * @return string
     */
    public function getDataSourceType();
}