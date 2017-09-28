<?php

namespace Saitow\Library\TiresDataSources;

use Saitow\Library\TiresDataSourceInterface;
use Saitow\Library\TiresDataSource;

class TiresSqlDataSource implements TiresDataSourceInterface
{

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function getDataSourceType()
    {
        return TiresDataSource::TYPE_SQL;
    }
}
