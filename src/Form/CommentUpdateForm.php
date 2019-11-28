<?php

namespace App\Form;

use App\Model\Validation\ImageValidator;
use App\Model\Validation\CommentIdValidator;
use App\Model\Validation\CommentValidator;
use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

/**
 * Comment Update Form.
 */
class CommentUpdateForm extends Form
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
        $postIdValidator = new CommentIdValidator();
        $validator = $postIdValidator->validationDefault($validator);

        $commentValidator = new CommentValidator();
        $validator = $commentValidator->notRequired($validator);

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
