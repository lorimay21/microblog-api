<?php

namespace App\Model\Validation;

use Cake\Validation\Validator;

class CommentIdValidator extends Validator
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
            ->requirePresence('comment_id', true, 'Comment ID is required')
            ->add('comment_id', [
                'type' => [
                    'rule' => ['numeric'],
                    'message' => 'Comment ID must be a positive integer'
                ]
            ]);

        return $validator;
    }
}
