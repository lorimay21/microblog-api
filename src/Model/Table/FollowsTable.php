<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class FollowsTable extends Table
{
    public function initialize(array $config)
    {
        $this->table('follows');

        $this->addBehavior('Timestamp');
        
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);
    }
}
