<?php

namespace App\Model\Validation;

use Cake\Validation\Validator;

class UserLastnameValidator extends Validator
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
            ->requirePresence('lastname', true, 'USER_LASTNAME_REQUIRED')
            ->add('lastname', [
                'length' => [
                    'rule' => ['maxLength', 250],
                    'message' => 'USER_LASTNAME_MAX_LENGTH'
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
            ->allowEmptyString('lastname')
            ->add('lastname', [
                'length' => [
                    'rule' => ['maxLength', 250],
                    'message' => 'USER_LASTNAME_MAX_LENGTH'
                ]
            ]);

        return $validator;
    }
}
