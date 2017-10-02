<?php


class TiresXmlDataSourceTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    private $instance;

    protected function _before()
    {
        /**
         * Data:
         * ID   manfacturer         name            additional      price   availability    product_image
         * "1"	"MANUFACTURER"	    "TIRE_NAME"	    "additional"	"12.34"	"1"	            "picture_url"
         * "2"	"MANUFACTURER_2"	"TIRE_NAME_2"	"additional"	"11.11"	"2"	            "picture_url"
         */
        $this->instance = new \Saitow\Library\TiresDataSources\TiresXmlDataSource('./tests/_data/tires-test.xml');
    }

    protected function _after()
    {
    }

    public function testGetDataSourceType()
    {
        $this->assertEquals(\Saitow\Library\TiresDataSource::TYPE_XML, $this->instance->getDataSourceType());
    }

    public function testGetById()
    {
        $tire = $this->instance->getById("1");

        $this->assertEquals(1,$tire->getRefId());
        $this->assertEquals('MANUFACTURER / TIRE_NAME', $tire->getTitle());
        $this->assertEquals('additional', $tire->getDescription());
        $this->assertEquals(12.34, $tire->getPrice());
        $this->assertEquals('picture_url', $tire->getImage());
    }

    public function testGetAll()
    {
        $tires = $this->instance->getAll();

        $this->assertEquals(1,$tires[0]->getRefId());
        $this->assertEquals('MANUFACTURER / TIRE_NAME', $tires[0]->getTitle());
        $this->assertEquals('additional', $tires[0]->getDescription());
        $this->assertEquals(12.34, $tires[0]->getPrice());
        $this->assertEquals('picture_url', $tires[0]->getImage());

        $this->assertEquals(2,$tires[1]->getRefId());
        $this->assertEquals('MANUFACTURER_2 / TIRE_NAME_2', $tires[1]->getTitle());
        $this->assertEquals('additional', $tires[1]->getDescription());
        $this->assertEquals(11.11, $tires[1]->getPrice());
        $this->assertEquals('picture_url', $tires[1]->getImage());
    }

    /**
     *
     */
    public function testGetAllWithNameFilter()
    {
        $tires = $this->instance->getAll('name_2');

        $this->assertEquals(2,$tires[0]->getRefId());
        $this->assertEquals('MANUFACTURER_2 / TIRE_NAME_2', $tires[0]->getTitle());
        $this->assertEquals('additional', $tires[0]->getDescription());
        $this->assertEquals(11.11, $tires[0]->getPrice());
        $this->assertEquals('picture_url', $tires[0]->getImage());
    }

}