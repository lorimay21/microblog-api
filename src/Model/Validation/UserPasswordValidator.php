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
            ->requirePresence('password', true, 'Password is required')
            ->add('password', [
                'length' => [
                    'rule' => ['maxLength', 250],
                    'message' => 'Password must not be greater than 250 characters'
                ],
                'alphanumeric' => [
                    'rule' => ['custom', '/^[A-Za-z0-9_@.,#&+-]*$/i'],
                    'message' => 'Password must be a combination of alphanumeric characters and symbols'
                ]
            ]);

        return $validator;
    }
}
