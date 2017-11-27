<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 30.01.2017
 * Time: 12:42
 */

namespace Core\Exception;


class ModelNotDefinedException extends LedgerException {

    public function __construct($message = null)
    {
        $this->message = 'Model not defined for ' .
            (is_null($message) ? 'this object' : $message);
    }
} 