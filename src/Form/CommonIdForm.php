<?php

namespace App\Form;

use App\Model\Validation\CommentIdValidator;
use App\Model\Validation\FollowIdValidator;
use App\Model\Validation\LikeIdValidator;
use App\Model\Validation\PostIdValidator;
use App\Model\Validation\RepostIdValidator;
use App\Model\Validation\UserIdValidator;
use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

/**
 * Common ID Form.
 */
class CommonIdForm extends Form
{
    /**
     * Build User Id validator
     *
     * @param \Cake\Validation\Validator $validator to use against the form
     * @return \Cake\Validation\Validator
     */
    public function userIdRequired(Validator $validator)
    {
        $idValidator = new UserIdValidator();
        $validator = $idValidator->validationDefault($validator);

        return $validator;
    }

    /**
     * Build Post Id validator
     *
     * @param \Cake\Validation\Validator $validator to use against the form
     * @return \Cake\Validation\Validator
     */
    public function postIdRequired(Validator $validator)
    {
        $idValidator = new PostIdValidator();
        $validator = $idValidator->validationDefault($validator);

        return $validator;
    }

    /**
     * Build Comment Id validator
     *
     * @param \Cake\Validation\Validator $validator to use against the form
     * @return \Cake\Validation\Validator
     */
    public function commentIdRequired(Validator $validator)
    {
        $idValidator = new CommentIdValidator();
        $validator = $idValidator->validationDefault($validator);

        return $validator;
    }

    /**
     * Build Like Id validator
     *
     * @param \Cake\Validation\Validator $validator to use against the form
     * @return \Cake\Validation\Validator
     */
    public function likeIdRequired(Validator $validator)
    {
        $idValidator = new LikeIdValidator();
        $validator = $idValidator->validationDefault($validator);

        return $validator;
    }

    /**
     * Build Repost Id validator
     *
     * @param \Cake\Validation\Validator $validator to use against the form
     * @return \Cake\Validation\Validator
     */
    public function repostIdRequired(Validator $validator)
    {
        $idValidator = new RepostIdValidator();
        $validator = $idValidator->validationDefault($validator);

        return $validator;
    }

    /**
     * Build Follow Id validator
     *
     * @param \Cake\Validation\Validator $validator to use against the form
     * @return \Cake\Validation\Validator
     */
    public function followIdRequired(Validator $validator)
    {
        $idValidator = new FollowIdValidator();
        $validator = $idValidator->validationDefault($validator);

        return $validator;
    }

    /**
     * Build User Id and Post Id validator
     *
     * @param \Cake\Validation\Validator $validator to use against the form
     * @return \Cake\Validation\Validator
     */
    public function userIdAndPostIdRequired(Validator $validator)
    {
        $userIdValidator = new UserIdValidator();
        $validator = $userIdValidator->validationDefault($validator);

        $postIdValidator = new PostIdValidator();
        $validator = $postIdValidator->validationDefault($validator);

        return $validator;
    }

    /**
     * Build User Id and Post Id validator
     *
     * @param \Cake\Validation\Validator $validator to use against the form
     * @return \Cake\Validation\Validator
     */
    public function userIdAndPostIdNotRequired(Validator $validator)
    {
        $userIdValidator = new UserIdValidator();
        $validator = $userIdValidator->notRequired($validator);

        $postIdValidator = new PostIdValidator();
        $validator = $postIdValidator->notRequired($validator);

        return $validator;
    }

    /**
     * Build User Id and Post Id validator
     *
     * @param \Cake\Validation\Validator $validator to use against the form
     * @return \Cake\Validation\Validator
     */
    public function userIdandFollowIdRequired(Validator $validator)
    {
        $userIdValidator = new UserIdValidator();
        $validator = $userIdValidator->validationDefault($validator);

        $followIdValidator = new FollowIdValidator();
        $validator = $followIdValidator->validationDefault($validator);

        return $validator;
    }

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
