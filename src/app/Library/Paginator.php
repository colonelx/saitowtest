<?php

namespace Saitow\Library;

/**
 * Class Paginator
 * @package Saitow\Library
 */
class Paginator
{
    protected $currentPage;
    protected $totalResources;
    protected $perPage;
    protected $currentPageOffset;
    protected $allItems;
    /**
     * Paginator constructor.
     * @param $currentPage
     * @param $allItems
     * @param $perPage
     * @param int $currentPageOffset
     */
    public function __construct($currentPage, $perPage, $allItems, $currentPageOffset = 5 )
    {
        $this->currentPage = (int)$currentPage;
        $this->totalResources = (int)sizeof($allItems);
        $this->allItems = $allItems;
        $this->perPage = (int)$perPage;
        $this->currentPageOffset = (int)$currentPageOffset;
    }

    /**
     * Handles the creation of an array to be used in the views
     * This could be written way better, but for the sake of this demo I will just use arrays.
     * @return array
     */
    public function getPaginationLinks()
    {
        $links = [];
        if ($this->currentPage !== 1) {
            $links[] = ['link_suffix' => '1', 'name' => 'First Page', 'active' => false];
        }

        if($this->currentPage > 1) {
            $prev_start = $this->currentPage - 1;
            $min_prev_page = $this->currentPage - $this->currentPageOffset;

            if ($min_prev_page < 1) $min_prev_page = 1;

            for ($prev_page = $min_prev_page; $prev_page <= $prev_start; $prev_page++)
                $links[] = ['link_suffix' => $prev_page, 'name' => $prev_page, 'active' => false];
        }

        $links[] = [
            'link_suffix' => $this->currentPage,
            'name' => $this->currentPage,
            'active' => true
        ];

        if($this->currentPage < $this->getMaxPages()) {
            $next_start = $this->currentPage + 1;
            $max_next_page = $this->currentPage + $this->currentPageOffset;

            if ($max_next_page > $this->getMaxPages()) $max_next_page = $this->getMaxPages();

            for ($next_page = $next_start; $next_page <= $max_next_page; $next_page++)
                $links[] = ['link_suffix' => $next_page, 'name' => $next_page, 'active' => false];
        }

        if ($this->currentPage !== $this->getMaxPages()) {
            $links[] = ['link_suffix' => $this->getMaxPages(), 'name' => 'Last Page', 'active' => false];
        }

        return $links;
    }

    /**
     * Returns the elements on the given page
     * @return array
     */
    public function getPageItems()
    {
        return array_slice($this->allItems, $this->getOffset(), $this->perPage);
    }

    /**
     * Calculates the request offset used in the API call
     * @return int
     *
     */
    private function getOffset()
    {
        return (int)($this->currentPage-1) * $this->perPage;
    }

    /**
     * Calculates the maximum amount of pages
     * @return int
     */
    private function getMaxPages()
    {
        return (int) ceil($this->totalResources / $this->perPage );
    }
}