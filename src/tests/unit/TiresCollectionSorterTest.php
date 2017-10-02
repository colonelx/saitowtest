<?php


use Saitow\Library\TiresCollectionSorter;

class TiresCollectionSorterTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;
    private $items;

    protected function _before()
    {

    }

    protected function _after()
    {
    }

    /**
     * Should return: $item2, $item1, $item3
     */
    public function testSortByTitle()
    {
        $item1 = new \Saitow\Model\Tire('sql', 1);
        $item1->setTitle('B');

        $item2 = new Saitow\Model\Tire('xml', 50);
        $item2->setTitle('A');

        $item3 = new \Saitow\Model\Tire('other', 22);
        $item3->setTitle('C');

        $items = [$item1, $item2, $item3];

        $sorted = TiresCollectionSorter::sort($items, \Saitow\Library\TiresDataSource::ORDERBY_MANUFACTURE);

        $this->assertEquals($item2, $sorted[0]);
        $this->assertEquals($item1, $sorted[1]);
        $this->assertEquals($item3, $sorted[2]);
    }

    /**
     * Should return: $item3, $item1, $item2
     */
    public function testSortByPrice()
    {
        $item1 = new \Saitow\Model\Tire('sql', 1);
        $item1->setPrice(1.1);

        $item2 = new Saitow\Model\Tire('xml', 50);
        $item2->setPrice(2.2);

        $item3 = new \Saitow\Model\Tire('other', 22);
        $item3->setPrice(0.1);

        $items = [$item1, $item2, $item3];

        $sorted = TiresCollectionSorter::sort($items, \Saitow\Library\TiresDataSource::ORDERBY_PRICE);

        $this->assertEquals($item3, $sorted[0]);
        $this->assertEquals($item1, $sorted[1]);
        $this->assertEquals($item2, $sorted[2]);
    }

}