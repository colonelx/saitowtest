<?php

namespace Saitow\Library\TiresDataSources;

use Saitow\Library\TiresDataSourceInterface;
use Saitow\Library\TiresDataSource;
use Saitow\Model\Tire;

/**
 * Class TiresSqlDataSource
 * @package Saitow\Library\TiresDataSources
 */
class TiresSqlDataSource implements TiresDataSourceInterface
{
    private $db;
    private $tableName = 'tires';

    /**
     * TiresSqlDataSource constructor.
     * @param $filePath
     */
    public function __construct($filePath)
    {
        $this->db = new \SQLite3($filePath);
    }

    /**
     * {@inheritDoc}
     */
    public function getAll($searchTerm = '')
    {
        $results = [];
        $sql = (empty($searchTerm)) ? sprintf('SELECT * FROM %s', $this->tableName) :
            sprintf("SELECT * FROM %s WHERE manufacturer LIKE :term OR name LIKE :term", $this->tableName);

        $statement = $this->db->prepare($sql);
        $statement->bindValue(':term', '%'.$searchTerm.'%');

        $tireRows = $statement->execute();
        while ($row = $tireRows->fetchArray()) {
            $tire = new Tire($this->getDataSourceType(), $row['id']);
            $tire->setTitle($row['manufacturer'] . ' / ' . $row['name']);
            $tire->setDescription($row['additional']);
            $tire->setImage($row['product_image']);
            $tire->setPrice($row['price']);

            $results[] = $tire;
        }

        return $results;
    }

    /**
     * {@inheritDoc}
     */
    public function getById($id)
    {
        $statement = $this->db->prepare(sprintf('SELECT * FROM %s WHERE id = :id', $this->tableName));
        $statement->bindValue(':id', $id);

        $result = $statement->execute();
        $row = $result->fetchArray();
        $tire = new Tire($this->getDataSourceType(), $row['id']);
        $tire->setTitle($row['manufacturer'] . ' / ' . $row['name']);
        $tire->setDescription($row['additional']);
        $tire->setImage($row['product_image']);
        $tire->setPrice($row['price']);

        return $tire;
    }

    /**
     * {@inheritDoc}
     */
    public function getDataSourceType()
    {
        return TiresDataSource::TYPE_SQL;
    }
}
