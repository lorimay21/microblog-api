<?php

namespace App\Model\Validation;

use Cake\Validation\Validator;

class FollowIdValidator extends Validator
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
            ->requirePresence('follow_id', true, 'FOLLOW_ID_REQUIRED')
            ->add('follow_id', [
                'type' => [
                    'rule' => ['numeric'],
                    'message' => 'FOLLOW_ID_INVALID_TYPE'
                ]
            ]);

        return $validator;
    }
}
