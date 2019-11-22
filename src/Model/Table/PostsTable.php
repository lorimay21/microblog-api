<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Posts Model
 */
class PostsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('posts');

        $this->hasMany('Comments', [
            'foreignKey' => 'post_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        // $validator
        //     ->nonNegativeInteger('id')
        //     ->allowEmptyString('id', 'create');

        // $validator
        //     ->scalar('password')
        //     ->requirePresence('password', 'create')
        //     ->allowEmptyString('password', false);

        // $validator
        //     ->email('email')
        //     ->allowEmptyString('email');

        // $validator
        //     ->integer('send_mail_flag')
        //     ->allowEmptyString('send_mail_flag');

        // $validator
        //     ->scalar('login_key')
        //     ->allowEmptyString('login_key');

        // return $validator;
    }
}
