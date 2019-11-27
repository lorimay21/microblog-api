<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class LikesTable extends Table
{
    public function initialize(array $config)
    {
        $this->table('likes');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);

        $this->belongsTo('Posts', [
            'foreignKey' => 'post_id'
        ]);
    }
}
