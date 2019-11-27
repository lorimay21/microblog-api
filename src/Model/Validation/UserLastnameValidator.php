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
            ->requirePresence('lastname', true, 'Lastname is required')
            ->add('lastname', [
                'length' => [
                    'rule' => ['maxLength', 250],
                    'message' => 'Lastname must not be greater than 250 characters'
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
                    'message' => 'Lastname must not be greater than 250 characters'
                ]
            ]);

        return $validator;
    }
}
