<?php

namespace App\Form;

use App\Model\Validation\ImageValidator;
use App\Model\Validation\UserBirthdayValidator;
use App\Model\Validation\UserEmailValidator;
use App\Model\Validation\UserFirstnameValidator;
use App\Model\Validation\UserGenderValidator;
use App\Model\Validation\UserIdValidator;
use App\Model\Validation\UserLastnameValidator;
use App\Model\Validation\UserUsernameValidator;
use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

/**
 * User Update Form.
 */
class UserUpdateForm extends Form
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
        $userIdValidator = new UserIdValidator($validator);
        $validator = $userIdValidator->validationDefault($validator);

        $firstnameValidator = new UserFirstnameValidator();
        $validator = $firstnameValidator->notRequired($validator);

        $lastnameValidator = new UserLastnameValidator();
        $validator = $lastnameValidator->notRequired($validator);

        $usernameValidator = new UserUsernameValidator();
        $validator = $usernameValidator->notRequired($validator);

        $emailValidator = new UserEmailValidator();
        $validator = $emailValidator->notRequired($validator);

        $birthdayValidator = new UserBirthdayValidator();
        $validator = $birthdayValidator->notRequired($validator);

        $genderValidator = new UserGenderValidator();
        $validator = $genderValidator->validationDefault($validator);

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
