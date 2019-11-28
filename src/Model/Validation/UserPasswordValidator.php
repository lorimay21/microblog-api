<?php

namespace App\Model\Validation;

use Cake\Validation\Validator;

class UserPasswordValidator extends Validator
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
            ->requirePresence('password', true, 'USER_PASSWORD_REQUIRED')
            ->add('password', [
                'length' => [
                    'rule' => ['maxLength', 250],
                    'message' => 'USER_PASSWORD_LENGTH'
                ],
                'alphanumeric' => [
                    'rule' => ['custom', '/^[A-Za-z0-9_@.,#&+-]*$/i'],
                    'message' => 'USER_PASSWORD_SYNTAX'
                ]
            ]);

        return $validator;
    }
}
