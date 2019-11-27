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
                    'message' => 'Gender must be a positive integer'
                ],
                'valid' => [
                    'rule' => ['inList', [1, 2]],
                    'message' => 'Gender must be either 1 for Male or 2 for Female only'
                ]
            ]);

        return $validator;
    }
}
