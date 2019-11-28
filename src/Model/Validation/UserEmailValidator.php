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
            ->requirePresence('email', true, 'USER_EMAIL_REQUIRED')
            ->add('email', [
                'valid' => [
                    'rule' => ['email'],
                    'message' => 'USER_EMAIL_VALID'
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
                'valid' => [
                    'rule' => ['email'],
                    'message' => 'USER_EMAIL_VALID'
                ],
            ]);

        return $validator;
    }
}
