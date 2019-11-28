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
            ->requirePresence('post_id', true, 'POST_ID_REQUIRED')
            ->add('post_id', [
                'type' => [
                    'rule' => ['numeric'],
                    'message' => 'POST_ID_INVALID_TYPE'
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
                    'message' => 'POST_ID_INVALID_TYPE'
                ]
            ]);

        return $validator;
    }
}
