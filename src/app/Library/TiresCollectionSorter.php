<?php

namespace Saitow\Library;

use Saitow\Exceptions\TiresSorterException;

class TiresCollectionSorter
{
    public static function sort($data, $field)
    {
        switch ($field) {
            case TiresDataSource::ORDERBY_MANUFACTURE:
                usort($data, [self::class, 'manufactureSort']);
                break;
            case TiresDataSource::ORDERBY_PRICE:
                usort($data, [self::class, 'priceSort']);
                break;
            default:
                throw new TiresSorterException(sprintf("Order by '%s' is not a valid order field", $field));
        }

        return $data;
    }

    private static function manufactureSort($a, $b)
    {
        return strcmp($a->getTitle(), $b->getTitle());
    }

    private static function priceSort($a, $b)
    {
        $result = 0;
        if($a->getPrice() > $b->getPrice()) {
            $result = 1;
        } elseif ($a->getPrice() < $b->getPrice()) {
            $result = -1;
        }
        return $result;
    }
}
