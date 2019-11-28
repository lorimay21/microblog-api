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
            ->requirePresence('comment', true, 'COMMENT_CONTENT_REQUIRED')
            ->add('comment', [
                'length' => [
                    'rule' => ['maxLength', 500],
                    'message' => 'COMMENT_CONTENT_MAX_LENGTH'
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
                    'message' => 'COMMENT_CONTENT_MAX_LENGTH'
                ]
            ]);

        return $validator;
    }
}
