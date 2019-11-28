<?php

namespace App\Form;

use App\Model\Validation\ImageValidator;
use App\Model\Validation\PostContentValidator;
use App\Model\Validation\PostTitleValidator;
use App\Model\Validation\UserIdValidator;
use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

/**
 * Post Create Form.
 */
class PostCreateForm extends Form
{
    /**
     * Builds the schema for the modelless form
     *
     * @param \Cake\Form\Schema $schema From schema
     * @return \Cake\Form\Schema
     */
    protected function _buildSchema(Schema $schema)
    {
        return $schema;
    }

    /**
     * Form validation builder
     *
     * @param \Cake\Validation\Validator $validator to use against the form
     * @return \Cake\Validation\Validator
     */
    protected function _buildValidator(Validator $validator)
    {
        $userIdValidator = new UserIdValidator();
        $validator = $userIdValidator->validationDefault($validator);

        $postTitleValidator = new PostTitleValidator();
        $validator = $postTitleValidator->validationDefault($validator);

        $postContentValidator = new PostContentValidator();
        $validator = $postContentValidator->validationDefault($validator);

        $imageValidator = new ImageValidator();
        $validator = $imageValidator->validationDefault($validator);

        return $validator;
    }

    /**
     * Defines what to execute once the From is being processed
     *
     * @param array $data Form data.
     * @return bool
     */
    protected function _execute(array $data)
    {
        return true;
    }
}
