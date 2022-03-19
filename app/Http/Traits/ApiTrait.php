<?php
namespace  App\Http\Traits;

trait ApiTrait
{
    /**
     * Resource was successfully created
     *
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createdResponse($data)
    {
        $response = $this->ApiSuccessResponse(201, $data, 'Item Created successfully');

        return response()->json($response, 201);
    }

    /**
     * Resource was successfully updated
     *
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function updatedResponse($data)
    {
        $response = $this->ApiSuccessResponse(200, $data, 'Item Updated successfully');

        return response()->json($response, 200);
    }

    /**
     * Resource was successfully deleted
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function deletedResponse()
    {
        $response = $this->ApiSuccessResponse(204, [], 'Item Deleted successfully ');

        return response()->json($response);
    }

    /**
     * Returns general error
     *
     * @param $errors
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse($errors)
    {
        $response = $this->ApiErrorResponse(400, $errors);

        return response()->json($response, 400);
    }

    /**
     * Client does not have proper permissions to perform action.
     *
     * @param $errors
     * @return \Illuminate\Http\JsonResponse
     */
    protected function unAuthorizationResponse($errors)
    {
        $response = $this->ApiErrorResponse(403, $errors,
            'Forbidden');

        return response()->json($response, 403);
    }

    /**
     * Returns a list of resources
     *
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function listResponse($data)
    {
        $response = $this->ApiSuccessResponse(200, $data);

        return response()->json($response);
    }

    /**
     * Requested resource wasn't found
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function notFoundResponse()
    {
        $response = $this->ApiErrorResponse(404, [], 'Item Not Found');

        return response()->json($response, 404);
    }

    /**
     * Return information for single resource
     *
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function showResponse($data)
    {
        $response = $this->ApiSuccessResponse(200, $data);

        return response()->json($response);
    }

    /**
     * Return error when request is properly formatted, but contains validation errors
     *
     * @param $errors
     * @return \Illuminate\Http\JsonResponse
     */
    protected function validationErrorResponse($errors)
    {
        $response = $this->ApiErrorResponse(422, $errors, 'Unprocessable Entity');

        return response()->json($response, 422);
    }



    protected function registerResponse($data)
    {
        $response = $this->ApiSuccessResponse(201, $data, 'Account Created Successfully');

        return response()->json($response, 201);
    }


    /**
     * Standard error envelope structure
     *
     * @param int $status
     * @param array $errors
     * @param string $message
     * @return array
     */
    private function ApiErrorResponse(
        $status = 400,
        $errors = [],
        $message = 'Bad Request'
    )
    {
        return [
            'status' => $status,
            'message' => $message,
            'errors' => $errors,
        ];
    }

    /**
     * Standard success envelope structure
     *
     * @param int $status
     * @param array $data
     * @param string $message
     * @return array
     */
    private function ApiSuccessResponse(
        $status = 200,
        $data = [],
        $message = 'OK'
    )
    {
        return [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];
    }
}