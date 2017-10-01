<?php

namespace Saitow\Library;


interface TiresDataSourceInterface
{
    public function getAll($searchTerm);
    public function getById($id);
    public function getDataSourceType();
}