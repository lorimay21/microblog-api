<?php

namespace App\Model\Validation;

use Cake\Validation\Validator;

class UserConfirmPasswordValidator extends Validator
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
            ->requirePresence('confirm_password', true, 'USER_CONFIRMPASSWORD_REQUIRED')
            ->add('confirm_password', [
                'length' => [
                    'rule' => ['maxLength', 250],
                    'message' => 'USER_CONFIRMPASSWORD_LENGTH'
                ],
                'syntax' => [
                    'rule' => ['custom', '/^[A-Za-z0-9_@.,#&+-]*$/i'],
                    'message' => 'USER_CONFIRMPASSWORD_SYNTAX'
                ]
            ])
            ->sameAs('confirm_password', 'password', 'USER_CONFIRMPASSWORD_MATCH');

        return $validator;
    }
}
