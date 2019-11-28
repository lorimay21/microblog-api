<?php

namespace App\Model\Validation;

use Cake\Validation\Validator;

class UserFirstnameValidator extends Validator
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
            ->requirePresence('firstname', true, 'USER_FIRSTNAME_REQUIRED')
            ->add('firstname', [
                'length' => [
                    'rule' => ['maxLength', 250],
                    'message' => 'USER_FIRSTNAME_MAX_LENGTH'
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
            ->allowEmptyString('firstname')
            ->add('firstname', [
                'length' => [
                    'rule' => ['maxLength', 250],
                    'message' => 'USER_FIRSTNAME_MAX_LENGTH'
                ]
            ]);

        return $validator;
    }
}
