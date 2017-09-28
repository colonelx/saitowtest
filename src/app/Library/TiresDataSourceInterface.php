<?php

namespace Saitow\Library;


interface TiresDataSourceInterface
{
    public function getAll();
    public function getDataSourceType();
}