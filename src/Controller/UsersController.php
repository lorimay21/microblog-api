<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * UsersController
 */
class UsersController extends AppController
{
    /**
     * User registration API
     * 
     * url: /users
     * method: POST
     */
    public function register()
    {
        //
    }

    /**
     * Fetch user information API
     * 
     * url: /users
     * method: GET
     */
    public function index()
    {
        //
    }

    /**
     * Update user information API
     * 
     * url: /users
     * method: PUT
     */
    public function edit()
    {
        //
    }

    /**
     * Delete user account API
     * 
     * url: /users
     * method: DELETE
     */
    public function terminate()
    {
        //
    }

    /**
     * User login API
     * 
     * url: /login
     * method: GET
     */
    public function login()
    {
        //
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
        //
    }

    /**
     * Unfollow user API
     * 
     * url: /unfollow
     * method: DELETE
     */
    public function unfollow()
    {
        //
    }
}
