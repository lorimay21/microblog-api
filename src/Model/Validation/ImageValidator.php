<?php

namespace App\Model\Validation;

use Cake\Validation\Validator;

class ImageValidator extends Validator
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
            ->allowEmptyFile('image')
            ->add('image', [
                'filetype' => [
                    'rule' => ['extension'],
                    'message' => 'Image must be a valid image'
                ],
                // 'size' => [
                //     'rule' => ['fileSize', '<=', '5MB'],
                //     'message' => 'Image must be greater than 5MB'
                // ]
            ]);

        return $validator;
    }
}
