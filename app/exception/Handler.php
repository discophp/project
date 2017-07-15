<?php
namespace App\exceptions;

class Handler extends \Disco\exceptions\Handler {


    /**
     * @var string $defaultErrorMessage The default error message when no callable or template is configured to handle
     * the error code.
     */
    protected $defaultErrorMessage = 'Internal Server Error';


    /**
     * @var array $dontReport A list of Throwable class names that shouldn't generate log messaged.
    */
    protected $dontReport = [];


    /**
     * @var array $dontReportHttpResponseCodes Http Response code errors that should not be reported.
     */
    protected $dontReportHttpResponseCodes = [404];


    /**
     * @param \Throwable $e
     */
    public function report(\Throwable $e){
        parent::report($e);
    }


    /**
     * @param \Disco\http\Request $request
     * @param \Throwable $e
     *
     * @return \Disco\http\Response
     */
    public function render($request, $e){
        return parent::render($request, $e);
    }


}