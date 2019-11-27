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
            ->requirePresence('follow_id', true, 'Follow ID is required')
            ->add('follow_id', [
                'type' => [
                    'rule' => ['numeric'],
                    'message' => 'Follow ID must be a positive integer'
                ]
            ]);

        return $validator;
    }
}
