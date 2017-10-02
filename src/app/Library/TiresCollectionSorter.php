<?php

namespace Saitow\Library;

use Saitow\Exceptions\TiresSorterException;

/**
 * Class TiresCollectionSorter
 * @package Saitow\Library
 */
class TiresCollectionSorter
{
    /**
     * Sorts the provided array by a given field. Always by ascending order. No desc order yet.
     * @param $data - ArrayList<Tire>
     * @param $field - string
     * @return ArrayList<Tire>
     * @throws TiresSorterException
     */
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

    /**
     * Comparision between two items' titles, used by usort()
     * @param $a - Element 1 (it's title)
     * @param $b - Element 2 (it's title)
     * @return int (-1,0,1)
     */
    private static function manufactureSort($a, $b)
    {
        return strcmp($a->getTitle(), $b->getTitle());
    }

    /**
     * Compatision by two items' prices, used by usort()
     * @param $a - Element 1 (it's price)
     * @param $b - Element 2 (it's price)
     * @return int (-1,0,1)
     */
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
