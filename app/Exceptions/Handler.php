<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
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
        // Handling Invalid Token, Expired Token and other Exceptions in JWT
        if($exception instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
            return response()->json(['error'=>'Token không đúng','message'=>'Vui lòng kiểm tra lại Token!'],400);
        }elseif($exception instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
            return response()->json(['error'=>'Token hết hạn','message'=>'Vui lòng login lại!'],400);
        }elseif($exception instanceof \Tymon\JWTAuth\Exceptions\JWTException){
            return response()->json(['error'=>'There is problem with your token'],400);
        }
        return parent::render($request, $exception);
    }
}
