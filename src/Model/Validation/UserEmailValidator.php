<?php

namespace App\Model\Validation;

use Cake\Validation\Validator;

class UserEmailValidator extends Validator
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
            ->requirePresence('email', true, 'Email Address is required')
            ->add('email', [
                'length' => [
                    'rule' => ['maxLength', 250],
                    'message' => 'Email Address must not be greater than 250 characters'
                ],
                'valid' => [
                    'rule' => ['email'],
                    'message' => 'Email Address is invalid'
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
            ->allowEmptyString('email')
            ->add('email', [
                'length' => [
                    'rule' => ['maxLength', 250],
                    'message' => 'Email Address must not be greater than 250 characters'
                ],
                'valid' => [
                    'rule' => ['email'],
                    'message' => 'Email Address is invalid'
                ],
            ]);

        return $validator;
    }
}
