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
            ->requirePresence('repost_id', true, 'REPOST_ID_REQUIRED')
            ->add('repost_id', [
                'type' => [
                    'rule' => ['numeric'],
                    'message' => 'REPOST_ID_INVALID_TYPE'
                ]
            ]);

        return $validator;
    }
}
