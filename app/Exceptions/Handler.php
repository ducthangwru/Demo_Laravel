<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;

class Handler extends ExceptionHandler
{
    use \App\Traits\JsonResponse;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $errors = [];
        $message = 'Server Error';
        $parentRender = parent::render($request, $exception);

        if (env('APP_DEBUG')) {
            return $parentRender;
        }

        // if parent returns a JsonResponse
        // for example in case of a ValidationException
        if ($parentRender instanceof JsonResponse)
        {
            $data = $parentRender->getData(true);
            if (isset($data['message'])) {
                $message = $data['message'];
            }
            $statusCode = $parentRender->getStatusCode();
            switch ($statusCode) {
                case 422:
                    $message = 'INVALID_PARAMS';
                    $errors = $data;
                    break;
                case 405:
                    $message = 'Method Not Allowed';
                    break;
                default:
            }
            return $this->error($message, $errors, $parentRender->getStatusCode(), $parentRender->status());
        }
        return $this->error($exception->getMessage(), $errors, $parentRender->status(), $parentRender->status());
    }
}
