<?php

namespace App\Model\Validation;

use Cake\Validation\Validator;

class PostTitleValidator extends Validator
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
            ->requirePresence('title', true, 'Post title cannot be empty')
            ->add('title', [
                'length' => [
                    'rule' => ['maxLength', 250],
                    'message' => 'Maximum of 250 characters only'
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
            ->allowEmptyString('title')
            ->add('title', [
                'length' => [
                    'rule' => ['maxLength', 250],
                    'message' => 'Maximum of 250 characters only'
                ]
            ]);

        return $validator;
    }
}
