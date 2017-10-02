<?php


use Saitow\Library\Paginator;

class PaginatorTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /**
     * Should return:
     * [First Page=1][1][_2_][3][4][Last Page=7]
     */
    public function testPaginatorLinksSecondPage()
    {
        $paginator = new Paginator(2, 10, $this->getAllItems(), 2);
        $links = $paginator->getPaginationLinks();

        $this->assertEquals(6, sizeof($links));
        $this->assertEquals('First Page', $links[0]['name']);
        $this->assertEquals(1, $links[0]['link_suffix']);
        $this->assertTrue($links[2]['active']);
    }

    /**
     * Should return:
     * [_1_][2][3][Last Page=7]
     */
    public function testPaginatorLinksFirstPage()
    {
        $paginator = new Paginator(1, 10, $this->getAllItems(), 2);
        $links = $paginator->getPaginationLinks();

        $this->assertEquals(4, sizeof($links));
        $this->assertEquals('Last Page', $links[3]['name']);
        $this->assertTrue($links[0]['active']);
    }

    /**
     * Should return:
     * [First Page=1][5][6][_7_]
     */
    public function testPaginatorLinksLastPage()
    {
        $paginator = new Paginator(7, 10, $this->getAllItems(), 2);
        $links = $paginator->getPaginationLinks();

        $this->assertEquals(4, sizeof($links));
        $this->assertTrue($links[3]['active']);
        $this->assertNotEquals('Last Page', $links[3]['name']);
    }

    /**
     * Helper to pass all the page items.
     * @return array
     */
    private function getAllItems()
    {
        return array_fill(0, 66, 'item');
    }
}