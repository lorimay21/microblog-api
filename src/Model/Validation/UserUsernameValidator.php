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
            ->requirePresence('username', true, 'USER_USERNAME_REQUIRED')
            ->add('username', [
                'length' => [
                    'rule' => ['maxLength', 250],
                    'message' => 'USER_USERNAME_MAX_LENGTH'
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
                    'message' => 'USER_USERNAME_MAX_LENGTH'
                ]
            ]);

        return $validator;
    }
}
