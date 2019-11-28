<?php

namespace App\Model\Validation;

use Cake\Validation\Validator;

class UserBirthdayValidator extends Validator
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
            ->requirePresence('birthday', true, 'USER_BIRTHDAY_REQUIRED')
            ->add('birthday', [
                'valid' => [
                    'rule' => ['date'],
                    'message' => 'USER_BIRTHDAY_VALID'
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
            ->allowEmptyDate('birthday')
            ->add('birthday', [
                'valid' => [
                    'rule' => ['date'],
                    'message' => 'USER_BIRTHDAY_VALID'
                ]
            ]);

        return $validator;
    }
}
