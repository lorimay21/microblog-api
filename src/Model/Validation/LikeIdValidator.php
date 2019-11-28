<?php

namespace App\Model\Validation;

use Cake\Validation\Validator;

class LikeIdValidator extends Validator
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
            ->requirePresence('like_id', true, 'LIKE_ID_REQUIRED')
            ->add('like_id', [
                'type' => [
                    'rule' => ['numeric'],
                    'message' => 'LIKE_ID_INVALID_TYPE'
                ]
            ]);

        return $validator;
    }
}
