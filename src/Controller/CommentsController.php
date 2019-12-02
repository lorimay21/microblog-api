<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Form\CommentCreateForm;
use App\Form\CommentUpdateForm;
use App\Form\CommonIdForm;
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

        $data = $this->request->data;

        // build form validators
        $createForm = new CommentCreateForm();
        $createForm->execute($data);

        // get error validations
        $errors = $createForm->getErrors();

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

        $data = $this->request->data;

        // build form validators
        $updateForm = new CommentUpdateForm();
        $updateForm->execute($data);

        // get validation errors
        $errors = $updateForm->getErrors();

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

        $data = $this->request->query;

        // build form validators
        $idForm = new CommonIdForm();
        $validator = $idForm->commentIdRequired(new Validator());

        // get error validations
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

        return $response;
    }
}
