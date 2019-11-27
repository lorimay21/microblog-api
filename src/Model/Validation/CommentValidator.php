<?php

namespace App\Model\Validation;

use Cake\Validation\Validator;

class CommentValidator extends Validator
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
            ->requirePresence('comment', true, 'Comment cannot be empty')
            ->add('comment', [
                'length' => [
                    'rule' => ['maxLength', 500],
                    'message' => 'Maximum of 500 characters only'
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
            ->allowEmptyString('comment')
            ->add('comment', [
                'length' => [
                    'rule' => ['maxLength', 500],
                    'message' => 'Maximum of 500 characters only'
                ]
            ]);

        return $validator;
    }
}
