<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Throwable;

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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (NotFoundHttpException $e, $request) {
            $to_url = \DB::table('redirects')->where('from_url', url()->full())->select('to_url')->first();
            if ($to_url) {
                return \Redirect::to($to_url->to_url, 301);
            } else {
                return \Redirect::to('/');
            }
        });

        // $this->renderable(function (CustomException $e, $request) {
        //     return \Redirect::to('/');
        // });
    }
}
