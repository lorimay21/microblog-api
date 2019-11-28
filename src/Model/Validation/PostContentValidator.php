<?php

namespace App\Model\Validation;

use Cake\Validation\Validator;

class PostContentValidator extends Validator
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
            ->requirePresence('content', true, 'POST_CONTENT_REQUIRED')
            ->add('content', [
                'length' => [
                    'rule' => ['maxLength', 500],
                    'message' => 'POST_CONTENT_MAX_LENGTH'
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
            ->allowEmptyString('content')
            ->add('content', [
                'length' => [
                    'rule' => ['maxLength', 500],
                    'message' => 'POST_CONTENT_MAX_LENGTH'
                ]
            ]);

        return $validator;
    }
}
