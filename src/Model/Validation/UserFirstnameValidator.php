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
            ->requirePresence('firstname', true, 'Firstname is required')
            ->add('firstname', [
                'length' => [
                    'rule' => ['maxLength', 250],
                    'message' => 'Firstname must not be greater than 250 characters'
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
                    'message' => 'Firstname must not be greater than 250 characters'
                ]
            ]);

        return $validator;
    }
}
