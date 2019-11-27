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
            ->requirePresence('birthday', true, 'Birthday is required')
            ->add('birthday', [
                'valid' => [
                    'rule' => ['date'],
                    'message' => 'Birthday must be in Y-m-d format'
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
                    'message' => 'Birthday must be in Y-m-d format'
                ]
            ]);

        return $validator;
    }
}
