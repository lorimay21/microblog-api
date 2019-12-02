<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

/**
 * Rest Builder component
 */
class ResponseComponent extends Component
{
    /**
     * Reconstruct return data
     *
     * @param array $data Response data
     * @return array $data
     */
    public function buildData($data)
    {
        $responseData = [];

        foreach ($data as $key => $value) {
            foreach ($value as $message) {
                $responseData[] = [
                    'field_name' => $key,
                    'message_id' => $message,
                    'message' => __($message)
                ];
            }
        }

        return $responseData;
    }
}
