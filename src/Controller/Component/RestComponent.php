<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

/**
 * Rest component
 *
 * @property RequestHandlerComponent $RequestHandler
 */
class RestComponent extends Component
{
    /**
     * Load other components
     *
     * @var array
     */
    public $components = [
        'RequestHandler'
    ];

    /**
     * Set success response
     *
     * @param array $data Response data.
     * @param string $message Response message.
     *
     * @return null
     */
    public function setSuccessResponse($data = [], $message = 'Success')
    {
        $messageId = 'SUCCESS';

        return $this->setResponse(200, $data, $messageId, $message);
    }

    /**
     * Set bad request response
     *
     * @param array $data Response data.
     *
     * @return null
     */
    public function setBadRequestResponse($data = [])
    {
        $messageId = 'BAD_REQUEST_ERROR';
        $message = 'Invalid requests';

        return $this->setResponse(400, $data, $messageId, $message);
    }

    /**
     * Set unauthorized access response
     *
     * @param array $data Response data.
     *
     * @return null
     */
    public function setUnauthorizedResponse($data = [])
    {
        $messageId = 'UNAUTHORIZED_ERROR';
        $message = 'Unauthorized access to this page';

        return $this->setResponse(401, $data, $messageId, $message);
    }

    /**
     * Set page not found response
     *
     * @param array $data Response data.
     *
     * @return null
     */
    public function setNotFoundResponse($data = [])
    {
        $messageId = 'PAGE_NOT_FOUND';
        $message = 'Page not found';

        return $this->setResponse(404, $data, $messageId, $message);
    }

    /**
     * Set data not found response
     *
     * @param array $data Response data.
     * @param string $message Response message.
     *
     * @return null
     */
    public function setDataFoundResponse($data = [], $message = 'Not found')
    {
        $messageId = 'NOT_FOUND';

        return $this->setResponse(409, $data, $messageId, $message);
    }

    /**
     * Set unprocessed entity response
     *
     * @param array $data Response data.
     *
     * @return null
     */
    public function setUnprocessedResponse($data = [])
    {
        $messageId = 'UNPROCESSED_ENTITY_ERROR';
        $message = 'Invalid parameters';

        $data = $this->build_data($data);

        return $this->setResponse(422, $data, $messageId, $message);
    }

    /**
     * Set internal server error response
     *
     * @param array $data Response data.
     *
     * @return null
     */
    public function setErrorResponse($data = [])
    {
        $messageId = 'INTERNAL_SERVER_ERROR';
        $message = 'An unexpected error has occured!';

        return $this->setResponse(500, $data, $messageId, $message);
    }

    /**
     * Set response
     *
     * @param int $status HTTP status code.
     * @param array $data Response data.
     * @param string $messageId Response message id.
     * @param string $message Response message.
     */
    public function setResponse($status, $data, $messageId, $message)
    {
        $controller = $this->getController();

        $response = $controller->response;
        $response->statusCode($status);

        $controller->response = $response;

        $controller->set([
            'status_code' => $status,
            'message_id' => $messageId,
            'message' => $message,
            '_serialize' => ['status_code', 'message_id', 'message']
        ]);

        if ($data) {
            $controller->set([
                'data' => $data,
                '_serialize' => ['status_code', 'message_id', 'message', 'data']
            ]);
        }

        return $this->RequestHandler->renderAs($controller, 'json');
    }

    /**
     * Reconstruct return data
     *
     * @param array $data Response data
     * @return array $data
     */
    private function build_data($data)
    {
        $responseData = [];

        foreach ($data as $key => $value) {
            foreach ($value as $message) {
                $responseData[] = [
                    'field_name' => $key,
                    // 'message_id' => 'test',
                    'message' => $message
                ];
            }
        }

        return $responseData;
    }
}
