<?php

namespace App\Model\Validation;

use Cake\Validation\Validator;

class PostIdValidator extends Validator
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
            ->requirePresence('post_id', true, 'Post ID is required')
            ->add('post_id', [
                'type' => [
                    'rule' => ['numeric'],
                    'message' => 'Post ID must be a positive integer'
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
            ->allowEmpty('post_id')
            ->add('post_id', [
                'type' => [
                    'rule' => ['numeric'],
                    'message' => 'Post ID must be a positive integer'
                ]
            ]);

        return $validator;
    }
}
