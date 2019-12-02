<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Form\CommonIdForm;
use App\Form\PostCreateForm;
use Cake\Validation\Validator;

/**
 * PostsController
 * 
 * @property Posts $Posts
 */
class PostsController extends AppController
{
    /**
     * initialize function
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadModel('Likes');
        $this->loadModel('Posts');
        $this->loadModel('Reposts');
        $this->loadModel('Users');
    }

    /**
     * Display all posts / user's posts API
     * 
     * url: /posts
     * method: GET
     */
    public function index()
    {
        $response = $this->Rest->setBadRequestResponse();

        $data = $this->request->query;

        // build form validators
        $idForm = new CommonIdForm();
        $validator = $idForm->userIdAndPostIdNotRequired(new Validator());

        // get error validations
        $errors = $validator->errors($data);

        if ($errors) {
            return $this->Rest->setUnprocessedResponse($errors);
        }

        $posts = $this->Posts->find()
            ->contain(['Users', 'Comments']);

        if (isset($data['post_id'])) {
            $posts->where(['Posts.id' => $data['post_id']]);
        }
        if (isset($data['user_id'])) {
            $posts->where(['Posts.user_id' => $data['user_id']]);
        }

        $response = $this->Rest->setSuccessResponse($posts->toArray());

        return $response;
    }

    /**
     * Create post API
     * 
     * url: /posts
     * method: POST
     */
    public function create()
    {
        $response = $this->Rest->setBadRequestResponse();

        $data = $this->request->data;

        // set form validators
        $createForm = new PostCreateForm();
        $createForm->execute($data);

        // get validation errors
        $errors = $createForm->getErrors();

        if ($errors) {
            return $this->Rest->setUnprocessedResponse($errors);
        }

        $isExists = $this->Posts->exists(['id' => $data['user_id']]);

        if ($isExists) {
            try {
                $post = $this->Posts->newEntity();

                $post->user_id = $data['user_id'];
                $post->title = $data['title'];
                $post->content = $data['content'];

                $this->Posts->save($post);

                // if (!empty($data['image'])) {
                //     $img = explode('.', $data['image']);

                //     $imagePath = '/img/uploads/posts/' . $post->id . '/';
                //     $imageName = $img[0] . '_' . date('YmdHis') . '.' . $img[1];
                //     $image = $imagePath . $imageName;

                //     $post->image = $image;
                //     $this->Posts->save($post);
                // }

                $response = $this->Rest->setSuccessResponse($post);
            } catch (Exception $e) {
                $response = $this->Rest->setErrorResponse($e);
            }
        }

        return $response;
    }

    /**
     * Update post API
     * 
     * url: /posts
     * method: PUT
     */
    public function edit()
    {
        $response = $this->Rest->setBadRequestResponse();

        $data = $this->request->data;

        // set form validators
        $updateForm = new PostUpdateForm();
        $updateForm->execute($data);

        // get validation errors
        $errors = $updateForm->getErrors();

        if ($errors) {
            return $this->Rest->setUnprocessedResponse($errors);
        }

        $isExists = $this->Posts->exists(['id' => $data['post_id']]);

        if ($isExists) {
            try {
                $post = $this->Posts->get($data['post_id']);

                if (isset($data['title'])) {
                    $post->title = $data['title'];
                }
                if (isset($data['content'])) {
                    $post->content = $data['content'];
                }

                $this->Posts->save($post);

                $response = $this->Rest->setSuccessResponse($post);
            } catch (Exception $e) {
                $response = $this->Rest->setErrorResponse($e);
            }
        }

        return $response;
    }

    /**
     * Delete post API
     * 
     * url: /posts
     * method: DELETE
     */
    public function delete()
    {
        $response = $this->Rest->setBadRequestResponse();

        $data = $this->request->query;

        // build form validators
        $idForm = new CommonIdForm();
        $validator = $idForm->postIdRequired(new Validator());

        // get error validations
        $errors = $validator->errors($data);

        if ($errors) {
            return $this->Rest->setUnprocessedResponse($errors);
        }

        $isExists = $this->Users->exists(['id' => $data['post_id']]);

        if ($isExists) {
            try {
                $post = $this->Posts->get($data['post_id']);
                $this->Posts->delete($post);

                $response = $this->Rest->setSuccessResponse([], 'Post has been deleted');
            } catch (Exception $e) {
                $response = $this->Rest->setErrorResponse($e);
            }
        }

        return $response;
    }

    /**
     * Display post API
     * 
     * url: /view
     * method: GET
     */
    public function view()
    {
        $response = $this->Rest->setBadRequestResponse();

        $data = $this->request->query;

        // build form validators
        $idForm = new CommonIdForm();
        $validator = $idForm->postIdRequired(new Validator());

        // get error validations
        $errors = $validator->errors($data);

        if ($errors) {
            return $this->Rest->setUnprocessedResponse($errors);
        }

        $post = $this->Posts->find()
            ->where(['Posts.id' => $data['post_id']])
            ->contain(['Users', 'Comments'])
            ->toArray();

        $response = $this->Rest->setSuccessResponse($post);

        return $response;
    }

    /**
     * Like post API
     * 
     * url: /like
     * method: POST
     */
    public function like()
    {
        $response = $this->Rest->setBadRequestResponse();

        $data = $this->request->data;

        // build form validators
        $idForm = new CommonIdForm();
        $validator = $idForm->userIdAndPostIdRequired(new Validator());

        // get error validations
        $errors = $validator->errors($data);

        if ($errors) {
            return $this->Rest->setUnprocessedResponse($errors);
        }

        $isLiked = $this->Likes->exists([
            'user_id' => $data['user_id'],
            'post_id' => $data['post_id']
        ]);

        if (!$isLiked) {
            try {
                $like = $this->Likes->newEntity();

                $like->user_id = $data['user_id'];
                $like->post_id = $data['post_id'];

                $this->Likes->save($like);

                $response = $this->Rest->setSuccessResponse([], 'Post has been liked');
            } catch (Exception $e) {
                $response = $this->Rest->setErrorResponse($e);
            }
        }

        return $response;
    }

    /**
     * Like post API
     * 
     * url: /unlike
     * method: DELETE
     */
    public function unlike()
    {
        $response = $this->Rest->setBadRequestResponse();

        $data = $this->request->query;

        // build form validators
        $idForm = new CommonIdForm();
        $validator = $idForm->likeIdRequired(new Validator());

        // get error validations
        $errors = $validator->errors($data);

        if ($errors) {
            return $this->Rest->setUnprocessedResponse($errors);
        }

        $isExists = $this->Users->exists(['id' => $data['like_id']]);

        if ($isExists) {
            try {
                $like = $this->Likes->get($data['like_id']);
                $this->Likes->delete($like);

                $response = $this->Rest->setSuccessResponse([], 'Post has been unliked');
            } catch (Exception $e) {
                $response = $this->Rest->setErrorResponse($e);
            }
        }

        return $response;
    }

    /**
     * Repost post API
     * 
     * url: /repost
     * method: POST
     */
    public function repost()
    {
        $response = $this->Rest->setBadRequestResponse();

        $data = $this->request->data;

        // build form validators
        $idForm = new CommonIdForm();
        $validator = $idForm->userIdAndPostIdRequired(new Validator());

        // get error validations
        $errors = $validator->errors($data);

        if ($errors) {
            return $this->Rest->setUnprocessedResponse($errors);
        }

        $isReposted = $this->Reposts->exists([
            'user_id' => $data['user_id'],
            'post_id' => $data['post_id']
        ]);

        if (!$isReposted) {
            try {
                $repost = $this->Reposts->newEntity();

                $repost->user_id = $data['user_id'];
                $repost->post_id = $data['post_id'];

                $this->Reposts->save($repost);

                $response = $this->Rest->setSuccessResponse([], 'Post has been reposted');
            } catch (Exception $e) {
                $response = $this->Rest->setErrorResponse($e);
            }
        }

        return $response;
    }

    /**
     * Unrepost post API
     * 
     * url: /unrepost
     * method: DELETE
     */
    public function unrepost()
    {
        $response = $this->Rest->setBadRequestResponse();

        $data = $this->request->query;

        // build form validators
        $idForm = new CommonIdForm();
        $validator = $idForm->repostIdRequired(new Validator());

        // get error validations
        $errors = $validator->errors($data);

        if ($errors) {
            return $this->Rest->setUnprocessedResponse($errors);
        }

        $isExists = $this->Users->exists(['id' => $data['repost_id']]);

        if ($isExists) {
            try {
                $repost = $this->Reposts->get($data['repost_id']);
                $this->Reposts->delete($repost);

                $response = $this->Rest->setSuccessResponse([], 'Post has been unreposted');
            } catch (Exception $e) {
                $response = $this->Rest->setErrorResponse($e);
            }
        }

        return $response;
    }
}
