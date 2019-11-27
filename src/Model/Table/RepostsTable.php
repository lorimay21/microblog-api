<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class RepostsTable extends Table
{
    public function initialize(array $config)
    {
        $this->table('reposts');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id'
        ]);

        $this->belongsTo('Posts', [
            'foreignKey' => 'post_id'
        ]);
    }
}
