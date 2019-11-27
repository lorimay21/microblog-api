<?php

namespace App\Model\Validation;

use Cake\Validation\Validator;

class UserUsernameValidator extends Validator
{
    /**
     * validationDefault Method
     *
     * @param Cake\Validation\Validator $validator instance of a validator
     * @return Cake\Validation\Validator
     */
    public function validationDefault($validator)
    {
        $validator
            ->requirePresence('username', true, 'Username is required')
            ->add('username', [
                'length' => [
                    'rule' => ['maxLength', 250],
                    'message' => 'Username must not be greater than 250 characters'
                ]
            ]);

        return $validator;
    }

    /**
     * Not required method
     *
     * @param Cake\Validation\Validator $validator instance of a validator
     * @return Cake\Validation\Validator
     */
    public function notRequired($validator)
    {
        $validator
            ->allowEmptyString('username')
            ->add('username', [
                'length' => [
                    'rule' => ['maxLength', 250],
                    'message' => 'Username must not be greater than 250 characters'
                ]
            ]);

        return $validator;
    }
}
