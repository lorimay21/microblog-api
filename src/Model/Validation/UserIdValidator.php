<?php

namespace App\Model\Validation;

use Cake\Validation\Validator;

class UserIdValidator extends Validator
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
            ->requirePresence('user_id', true, 'USER_ID_REQUIRED')
            ->add('user_id', [
                'type' => [
                    'rule' => ['numeric'],
                    'message' => 'USER_ID_INVALID_TYPE'
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
            ->allowEmpty('user_id')
            ->add('user_id', [
                'type' => [
                    'rule' => ['numeric'],
                    'message' => 'USER_ID_INVALID_TYPE'
                ]
            ]);

        return $validator;
    }
}
