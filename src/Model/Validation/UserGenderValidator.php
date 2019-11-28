<?php

namespace App\Model\Validation;

use Cake\Validation\Validator;

class UserGenderValidator extends Validator
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
            ->allowEmpty('gender')
            ->add('gender', [
                'type' => [
                    'rule' => 'numeric',
                    'message' => 'USER_GENDER_INVALID_TYPE'
                ],
                'valid' => [
                    'rule' => ['inList', [1, 2]],
                    'message' => 'USER_GENDER_VALID'
                ]
            ]);

        return $validator;
    }
}
