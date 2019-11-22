<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class RepostsTable extends Table
{
    public function initialize(array $config)
    {
        $this->table('reposts');
    }
}
