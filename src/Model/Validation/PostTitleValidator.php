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
            ->requirePresence('title', true, 'POST_TITLE_REQUIRED')
            ->add('title', [
                'length' => [
                    'rule' => ['maxLength', 250],
                    'message' => 'POST_TITLE_MAX_LENGTH'
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
                    'message' => 'POST_TITLE_MAX_LENGTH'
                ]
            ]);

        return $validator;
    }
}
