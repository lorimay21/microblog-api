<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;

/**
 * Users Model
 */
class UsersTable extends Table
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

        $this->table('users');

        $this->addBehavior('Timestamp');

        $this->hasMany('Posts', [
            'foreignKey' => 'user_id'
        ]);
    }

    /**
     * build rules
     * 
     * @param Cake\ORM\RulesChecker $rules instance of a rule
     * @return Cake\ORM\RulesChecker 
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules
            ->add($rules->isUnique(['email'], 'USER_EMAIL_UNIQUE'))
            ->add($rules->isUnique(['username'], 'USER_USERNAME_UNIQUE'));

        return $rules;
    }
}
