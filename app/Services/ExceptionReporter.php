<?php

namespace App\Services;

use \Exception;
use App\ExceptionLog;
use Illuminate\Support\Facades\Schema;

class ExceptionReporter
{
    protected $exception;

    /**
     * Constructor
     * @param  \Exception $exception
     * @return void
     */
    public function __construct(Exception $exception)
    {
        $this->exception = $exception;
    }

    /**
     * Insert exception data to table
     * @return \App\Services\ExceptionLog
     */
    protected function log()
    {
        try {
            return ExceptionLog::insert([
                'route' => app('request')->method() . ' ' . app('request')->path(),
                'type' => get_class($this->exception),
                'code' => $this->exception->getCode(),
                'message' => $this->exception->getMessage(),
                'line' => $this->exception->getLine(),
                'file' => $this->exception->getfile()
            ]);
        } catch (QueryException $e) {
            return false;
        }
    }

    /**
     * Record and Report exception to correspondent
     * @return mixed
     */
    public function report()
    {
        // $this->log();
    }
}
