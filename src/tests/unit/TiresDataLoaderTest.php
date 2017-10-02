<?php

use Saitow\Exceptions\TiresNotFoundException;
use Saitow\Library\TiresDataLoader;

    /**
     * Class DataManager
     * Mock of TiresRepository
     */
    class DataManager
    {
        private $dataSources;
        public function __construct()
        {
            $this->dataSources = [
                new DataSource1(),
                new DataSource2()
            ];
        }

        function getDataSources()
        {
            return $this->dataSources;
        }
    }

    /**
     * Class DataSource1
     * Mock of TiresXXXDataSource
     */
    class DataSource1
    {
        function getAll()
        {
            return [1,2];
        }

        function getById()
        {
            // Test Exception
            return null;
        }

        function getDataSourceType()
        {
            return "typeOne";
        }
    }

    /**
     * Class DataSource2
     * Mock of TiresXXXDataSource
     */
    class DataSource2
    {
        function getAll()
        {
            return [3,4];
        }

        function getById()
        {
            return 3;
        }

        function getDataSourceType()
        {
            return "typeTwo";
        }
    }

    class TiresDataLoaderTest extends \Codeception\TestCase\Test
    {
   /**
    * @var \UnitTester
    */
    protected $tester;

    private $tiresLoader;

    protected function _before()
    {
        $this->tiresLoader = new TiresDataLoader(new DataManager());
    }

    protected function _after()
    {
    }

    /**
     * Check if all items from both Sources are loaded
     */
    public function testLoaderAll()
    {
        $allItems = $this->tiresLoader->all();

        $this->assertContains(1,$allItems);
        $this->assertContains(2,$allItems);
        $this->assertContains(3,$allItems);
        $this->assertContains(4,$allItems);
    }

    /**
     * Check correct return of item, according to DataSource
     */
    public function testLoaderSingle()
    {
        $dataSourceTwoItem = $this->tiresLoader->get('typeTwo', 3);

        $ex = null;

        try {
            $this->tiresLoader->get('typeOne', 1);
        } catch (Exception $e) {
            $ex = $e;
        }

        $this->assertTrue($ex instanceof TiresNotFoundException);
        $this->assertEquals(3, $dataSourceTwoItem);
    }


}