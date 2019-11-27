<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Validation\ImageValidator;
use App\Model\Validation\FollowIdValidator;
use App\Model\Validation\UserBirthdayValidator;
use App\Model\Validation\UserConfirmPasswordValidator;
use App\Model\Validation\UserEmailValidator;
use App\Model\Validation\UserFirstnameValidator;
use App\Model\Validation\UserGenderValidator;
use App\Model\Validation\UserIdValidator;
use App\Model\Validation\UserLastnameValidator;
use App\Model\Validation\UserPasswordValidator;
use App\Model\Validation\UserUsernameValidator;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Validation\Validator;

/**
 * UsersController
 * 
 * @property Users $Users
 */
class UsersController extends AppController
{
    /**
     * initialize function
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadModel('Follows');
        $this->loadModel('Users');
    }

    /**
     * User registration API
     * 
     * url: /users
     * method: POST
     */
    public function register()
    {
        $response = $this->Rest->setBadRequestResponse();

        if ($this->request->is('post')) {
            $data = $this->request->data;

            // build validators
            $validator = $this->build_create_user_validators();

            // get validation errors
            $errors = $validator->errors($data);

            if ($errors) {
                return $this->Rest->setUnprocessedResponse($errors);
            }

            try {
                $user = $this->Users->newEntity();

                // set data to save
                $user->firstname = $data['firstname'];
                $user->lastname = $data['lastname'];
                $user->username = $data['username'];
                $user->password = $this->hash_password($data['password']);
                $user->email = $data['email'];
                $user->birthday = $data['birthday'];
                $user->age = $this->get_age($data['birthday']);
                $user->is_enabled = 0;

                if (isset($data['gender'])) {
                    $user->gender = $data['gender'];
                }
                // if (isset($data['image'])) {
                //     $user->image = $data['image'];
                // }

                $this->Users->save($user);

                // logical errors
                if ($user->hasErrors()) {
                    $response = $this->Rest->setUnprocessedResponse($user->errors());
                } else {
                    $response = $this->Rest->setSuccessResponse($user);
                }
            } catch (Exception $e) {
                $response = $this->Rest->setErrorResponse($e);
            }
        }

        return $response;
    }

    /**
     * Fetch user information API
     * 
     * url: /users
     * method: GET
     */
    public function index()
    {
        $response = $this->Rest->setBadRequestResponse();

        if ($this->request->is('get')) {
            $data = $this->request->query;

            // set validators
            $validator = new Validator();
            $idValidator = new UserIdValidator();

            // get validation errors
            $validator = $idValidator->validationDefault($validator);
            $errors = $validator->errors($data);

            if ($errors) {
                return $this->Rest->setUnprocessedResponse($errors);
            }

            $user = $this->Users->find()
                ->where(['id' => $data['user_id']])
                ->first();

            $response = $this->Rest->setSuccessResponse($user);
        }

        return $response;
    }

    /**
     * Update user information API
     * 
     * url: /users
     * method: PUT
     */
    public function edit()
    {
        $response = $this->Rest->setBadRequestResponse();

        if ($this->request->is('put')) {
            $data = $this->request->data;

            // build validators
            $validator = $this->build_edit_user_validators();

            // get validation errors
            $errors = $validator->errors($data);

            if ($errors) {
                return $this->Rest->setUnprocessedResponse($errors);
            }

            $user = $this->Users->find()
                ->where(['id' => $data['user_id']])
                ->first();

            if ($user) {
                try {
                    // set data to update
                    if (isset($data['firstname'])) {
                        $user->firstname = $data['firstname'];
                    }
                    if (isset($data['lastname'])) {
                        $user->lastname = $data['lastname'];
                    }
                    if (isset($data['username'])) {
                        $user->username = $data['username'];
                    }
                    if (isset($data['email'])) {
                        $user->email = $data['email'];
                    }
                    if (isset($data['birthday'])) {
                        $user->birthday = $data['birthday'];
                        $user->age = $this->get_age($data['birthday']);
                    }
                    if (isset($data['gender'])) {
                        $user->gender = $data['gender'];
                    }
                    // if (isset($data['image'])) {
                    //     $user->image = $data['image'];
                    // }

                    $this->Users->save($user);

                    // logical errors
                    if ($user->hasErrors()) {
                        $response = $this->Rest->setUnprocessedResponse($user->errors());
                    } else {
                        $response = $this->Rest->setSuccessResponse($user);
                    }
                } catch (Exception $e) {
                    $response = $this->Rest->setErrorResponse($e);
                }
            }
        }

        return $response;
    }

    /**
     * Delete user account API
     * 
     * url: /users
     * method: DELETE
     */
    public function terminate()
    {
        $response = $this->Rest->setBadRequestResponse();

        if ($this->request->is('delete')) {
            $data = $this->request->query;

            // set validators
            $validator = new Validator();
            $idValidator = new UserIdValidator();

            // get validation errors
            $validator = $idValidator->validationDefault($validator);
            $errors = $validator->errors($data);

            if ($errors) {
                return $this->Rest->setUnprocessedResponse($errors);
            }

            $isExists = $this->Users->exists(['id' => $data['user_id']]);

            if ($isExists) {
                try {
                    // terminate
                    $user = $this->Users->get($data['user_id']);
                    $this->Users->delete($user);

                    $response = $this->Rest->setSuccessResponse();
                } catch (Exception $e) {
                    $response = $this->Rest->setErrorResponse($e);
                }
            }
        }

        return $response;
    }

    /**
     * User login API
     * 
     * url: /login
     * method: POST
     */
    public function login()
    {
        // $response = $this->Rest->setBadRequestResponse();

        // if ($this->request->is('get')) {
        //     $data = $this->request->query;

        //     pr($this->request);
        //     die();

        //     $user = $this->Auth->identify();

        //     if ($user) {
        //         $this->Auth->setUser($user);

        //         $response = $this->Rest->setSuccessResponse($user);
        //     } else {
        //         $response = $this->Rest->setUnprocessedError($user);
        //     }
        // }

        // return $response;
    }

    /**
     * User logout API
     * 
     * url: /logout
     * method: GET
     */
    public function logout()
    {
        //
    }

    /**
     * Follow user API
     * 
     * url: /follow
     * method: POST
     */
    public function follow()
    {
        $response = $this->Rest->setBadRequestResponse();

        if ($this->request->is('post')) {
            $data = $this->request->data;

            // set validators
            $validator = new Validator();
            $userIdValidator = new UserIdValidator();
            $followIdValidator = new FollowIdValidator();

            // get validation errors
            $validator = $userIdValidator->validationDefault($validator);
            $validator = $followIdValidator->validationDefault($validator);
            $errors = $validator->errors($data);

            if ($errors) {
                return $this->Rest->setUnprocessedResponse($errors);
            }

            $isFollowed = $this->Follows->exists([
                'user_id' => $data['user_id'],
                'follow_id' => $data['follow_id']
            ]);

            if (!$isFollowed) {
                try {
                    $follow = $this->Follows->newEntity();

                    $follow->user_id = $data['user_id'];
                    $follow->follow_id = $data['follow_id'];

                    $this->Follows->save($follow);

                    $response = $this->Rest->setSuccessResponse();
                } catch (Exception $e) {
                    $response = $this->Rest->setErrorResponse($e);
                }
            }
        }

        return $response;
    }

    /**
     * Unfollow user API
     * 
     * url: /unfollow
     * method: DELETE
     */
    public function unfollow()
    {
        $response = $this->Rest->setBadRequestResponse();

        if ($this->request->is('delete')) {
            $data = $this->request->query;

            // set validators
            $validator = new Validator();
            $idValidator = new FollowIdValidator();

            // get validation errors
            $validator = $idValidator->validationDefault($validator);
            $errors = $validator->errors($data);

            if ($errors) {
                return $this->Rest->setUnprocessedResponse($errors);
            }

            $isExists = $this->Users->exists(['id' => $data['follow_id']]);

            if ($isExists) {
                try {
                    $follow = $this->Follows->get($data['follow_id']);
                    $this->Follows->delete($follow);

                    $response = $this->Rest->setSuccessResponse();
                } catch (Exception $e) {
                    $response = $this->Rest->setErrorResponse($e);
                }
            }
        }

        return $response;
    }

    /**
     * Build reusable validators
     * 
     * @return object $validator
     */
    private function build_create_user_validators()
    {
        // set validators
        $validator = new Validator();
        $firstnameValidator = new UserFirstnameValidator();
        $lastnameValidator = new UserLastnameValidator();
        $usernameValidator = new UserUsernameValidator();
        $emailValidator = new UserEmailValidator();
        $passwordValidator = new UserPasswordValidator();
        $confirmPassValidator = new UserConfirmPasswordValidator();
        $birthdayValidator = new UserBirthdayValidator();
        $genderValidator = new UserGenderValidator();
        $imageValidator = new ImageValidator();

        // get validators
        $validator = $firstnameValidator->validationDefault($validator);
        $validator = $lastnameValidator->validationDefault($validator);
        $validator = $usernameValidator->validationDefault($validator);
        $validator = $emailValidator->validationDefault($validator);
        $validator = $passwordValidator->validationDefault($validator);
        $validator = $confirmPassValidator->validationDefault($validator);
        $validator = $birthdayValidator->validationDefault($validator);
        $validator = $genderValidator->validationDefault($validator);
        $validator = $imageValidator->validationDefault($validator);

        return $validator;
    }

    /**
     * Build reusable validators
     * 
     * @return object $validator
     */
    private function build_edit_user_validators()
    {
        // set validators
        $validator = new Validator();
        $userIdValidator = new UserIdValidator();
        $firstnameValidator = new UserFirstnameValidator();
        $lastnameValidator = new UserLastnameValidator();
        $usernameValidator = new UserUsernameValidator();
        $emailValidator = new UserEmailValidator();
        $birthdayValidator = new UserBirthdayValidator();
        $genderValidator = new UserGenderValidator();
        $imageValidator = new ImageValidator();

        // get validators
        $validator = $userIdValidator->validationDefault($validator);
        $validator = $firstnameValidator->notRequired($validator);
        $validator = $lastnameValidator->notRequired($validator);
        $validator = $usernameValidator->notRequired($validator);
        $validator = $emailValidator->notRequired($validator);
        $validator = $birthdayValidator->notRequired($validator);
        $validator = $genderValidator->validationDefault($validator);
        $validator = $imageValidator->validationDefault($validator);

        return $validator;
    }

    /**
     * Calculate age using birthday
     * 
     * @param date $birthday
     * @return int $age
     */
    private function get_age($birthday)
    {
        $bday = new \DateTime($birthday);
        $today = new \DateTime();

        return $bday->diff($today)->y;
    }

    /**
     * Hash user password
     * 
     * @param string $password
     * @return string $password
     */
    private function hash_password($password)
    {
        $hasher = new DefaultPasswordHasher();

        return $hasher->hash($password);
    }
}
