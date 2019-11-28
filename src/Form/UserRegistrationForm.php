<?php

namespace App\Form;

use App\Model\Validation\ImageValidator;
use App\Model\Validation\UserBirthdayValidator;
use App\Model\Validation\UserConfirmPasswordValidator;
use App\Model\Validation\UserEmailValidator;
use App\Model\Validation\UserFirstnameValidator;
use App\Model\Validation\UserGenderValidator;
use App\Model\Validation\UserLastnameValidator;
use App\Model\Validation\UserPasswordValidator;
use App\Model\Validation\UserUsernameValidator;
use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

/**
 * User Registration Form.
 */
class UserRegistrationForm extends Form
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
        $firstnameValidator = new UserFirstnameValidator();
        $validator = $firstnameValidator->validationDefault($validator);

        $lastnameValidator = new UserLastnameValidator();
        $validator = $lastnameValidator->validationDefault($validator);

        $usernameValidator = new UserUsernameValidator();
        $validator = $usernameValidator->validationDefault($validator);

        $emailValidator = new UserEmailValidator();
        $validator = $emailValidator->validationDefault($validator);

        $passwordValidator = new UserPasswordValidator();
        $validator = $passwordValidator->validationDefault($validator);

        $confirmPassValidator = new UserConfirmPasswordValidator();
        $validator = $confirmPassValidator->validationDefault($validator);

        $birthdayValidator = new UserBirthdayValidator();
        $validator = $birthdayValidator->validationDefault($validator);

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
