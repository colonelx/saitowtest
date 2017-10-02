<?php

namespace Saitow\Library;

/**
 * Class TiresDataSource
 * Consists of couple of declarations.
 * @package Saitow\Library
 */
abstract class TiresDataSource
{
    const TYPE_SQL = 'sql';
    const TYPE_XML = 'xml';

    const ORDERBY_MANUFACTURE = 'manufacture_and_name';
    const ORDERBY_PRICE = 'price';
}
