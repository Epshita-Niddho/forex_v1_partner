<?php

namespace App\Exceptions;


use Exception;

use Illuminate\Validation\ValidationException;

use Illuminate\Auth\AuthenticationException;

use Illuminate\Auth\Access\AuthorizationException;

use Illuminate\Database\Eloquent\ModelNotFoundException;

use Symfony\Component\HttpKernel\Exception\HttpException;

use Illuminate\Session\TokenMismatchException;

use Symfony\Component\Debug\Exception\FatalErrorException;





use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;


class Handler extends ExceptionHandler

{


     /**

     * A list of the exception types that should not be reported.

     *

     * @var array

     */

    protected $dontReport = [

         AuthenticationException::class,
        

        AuthorizationException::class,

        HttpException::class,

        ModelNotFoundException::class,

        ValidationException::class,
       
       TokenMismatchException::class,

       FatalErrorException::class,

    ];


     /**

     * Report or log an exception.

     *

     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.

     *

     * @param  \Exception  $e

     * @return void

     */

    public function report(Exception $e)

    {

        parent::report($e);
       


    }


     /**

     * Render an exception into an HTTP response.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \Exception  $e

     * @return \Illuminate\Http\Response

     */

    public function render($request, Exception $e)

    {

        // return redirect('/');

        if($this->isHttpException($e)){

            if (view()->exists('errors.'.$e->getStatusCode()))

            {

                return response()->view('errors.'.$e->getStatusCode(), [], $e->getStatusCode());

            }

        }

         if ($e instanceof TokenMismatchException) {    

             return redirect('login');
        }

         if ($e instanceof FatalErrorException) {    

             // return response()->view('errors.503');
        }

        return parent::render($request, $e);

        //return response()->view('errors.503');


         // return response()->view('errors.'.app()->getLocale().'.error');


    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }

}







?>