<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class LikesTable extends Table
{
    public function initialize(array $config)
    {
        $this->table('likes');
    }
}
