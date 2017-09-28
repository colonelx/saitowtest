<?php

namespace Saitow\Model;

use Saitow\Library\TiresStorageManager;

class TiresRepository
{

    private $manager;

    public function __construct(TiresStorageManager $manager)
    {
        $this->manager = $manager;
    }

    public function getAll($orderBy = '')
    {
        return $this->manager->getAll($orderBy);
    }

    public function search($string, $orderBy = '')
    {
        return $this->manager->search($string, $orderBy);
    }

    public function get($id)
    {
        return $this->manager->get($id);
    }
}
