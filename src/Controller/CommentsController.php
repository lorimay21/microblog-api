<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Validation\CommentIdValidator;
use App\Model\Validation\CommentValidator;
use App\Model\Validation\PostIdValidator;
use App\Model\Validation\ImageValidator;
use Cake\Validation\Validator;

/**
 * CommentsController
 * 
 * @property Comments $Comments
 */
class CommentsController extends AppController
{
    /**
     * initialize function
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadModel('Comments');
        $this->loadModel('Posts');
    }

    /**
     * Add comment API
     * 
     * url: /comments
     * method: POST
     */
    public function create()
    {
        $response = $this->Rest->setBadRequestResponse();

        if ($this->request->is('post')) {
            $data = $this->request->data;

            $validator = new Validator();
            $postIdValidator = new PostIdValidator();
            $commentValidator = new CommentValidator();
            $imageValidator = new ImageValidator();

            $validator = $postIdValidator->validationDefault($validator);
            $validator = $commentValidator->validationDefault($validator);
            $validator = $imageValidator->validationDefault($validator);
            $errors = $validator->errors($data);

            if ($errors) {
                return $this->Rest->setUnprocessedResponse($errors);
            }

            $isExists = $this->Posts->exists(['id' => $data['post_id']]);

            if ($isExists) {
                try {
                    $comment = $this->Comments->newEntity();

                    $comment->post_id = $data['post_id'];
                    $comment->comment = $data['comment'];

                    $this->Comments->save($comment);

                    $response = $this->Rest->setSuccessResponse($comment);
                } catch (Exception $e) {
                    $response = $this->Rest->setErrorResponse($e);
                }
            }
        }

        return $response;
    }

    /**
     * Update comment API
     * 
     * url: /comments
     * method: PUT
     */
    public function edit()
    {
        $response = $this->Rest->setBadRequestResponse();

        if ($this->request->is('put')) {
            $data = $this->request->data;

            $validator = new Validator();
            $commentIdValidator = new CommentIdValidator();
            $commentValidator = new CommentValidator();
            $imageValidator = new ImageValidator();

            $validator = $commentIdValidator->validationDefault($validator);
            $validator = $commentValidator->notRequired($validator);
            $validator = $imageValidator->validationDefault($validator);
            $errors = $validator->errors($data);

            if ($errors) {
                return $this->Rest->setUnprocessedResponse($errors);
            }

            $isExists = $this->Comments->exists(['id' => $data['comment_id']]);

            if ($isExists) {
                try {
                    $comment = $this->Comments->get($data['comment_id']);

                    if (isset($data['comment'])) {
                        $comment->comment = $data['comment'];
                    }

                    $this->Comments->save($comment);

                    $response = $this->Rest->setSuccessResponse($comment);
                } catch (Exception $e) {
                    $response = $this->Rest->setErrorResponse($e);
                }
            }
        }

        return $response;
    }

    /**
     * Delete comment API
     * 
     * url: /comments
     * method: DELETE
     */
    public function delete()
    {
        $response = $this->Rest->setBadRequestResponse();

        if ($this->request->is('delete')) {
            $data = $this->request->query;

            $validator = new Validator();
            $idValidator = new CommentIdValidator();

            $validator = $idValidator->validationDefault($validator);
            $errors = $validator->errors($data);

            if ($errors) {
                return $this->Rest->setUnprocessedResponse($errors);
            }

            $isExists = $this->Users->exists(['id' => $data['comment_id']]);

            if ($isExists) {
                try {
                    $comment = $this->Comments->get($data['comment_id']);
                    $this->Comments->delete($comment);

                    $response = $this->Rest->setSuccessResponse([], 'Comment has been deleted');
                } catch (Exception $e) {
                    $response = $this->Rest->setErrorResponse($e);
                }
            }
        }

        return $response;
    }
}
