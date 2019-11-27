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
            ->requirePresence('confirm_password', true, 'Confirm password is required')
            ->add('confirm_password', [
                'length' => [
                    'rule' => ['maxLength', 250],
                    'message' => 'Confirm password must not be greater than 250 characters'
                ],
                'syntax' => [
                    'rule' => ['custom', '/^[A-Za-z0-9_@.,#&+-]*$/i'],
                    'message' => 'Confirm password must be a combination of alphanumeric characters and symbols'
                ]
            ])
            ->sameAs('confirm_password', 'password', 'Passwords do not match');

        return $validator;
    }
}
