<?php

namespace App\Model\Validation;

use Cake\Validation\Validator;

class RepostIdValidator extends Validator
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
            ->requirePresence('repost_id', true, 'Repost ID is required')
            ->add('repost_id', [
                'type' => [
                    'rule' => ['numeric'],
                    'message' => 'Repost ID must be a positive integer'
                ]
            ]);

        return $validator;
    }
}
