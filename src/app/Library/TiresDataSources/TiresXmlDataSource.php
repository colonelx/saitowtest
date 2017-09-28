<?php

namespace Saitow\Library\TiresDataSources;

use Saitow\Library\TiresDataSource;
use Saitow\Library\TiresDataSourceInterface;

class TiresXmlDataSource implements TiresDataSourceInterface
{

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function getDataSourceType()
    {
        return TiresDataSource::TYPE_XML;
    }
}
