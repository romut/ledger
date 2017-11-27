<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 14.07.2017
 * Time: 16:24
 */

namespace Core\Exception;


class UnknownClientTypeException extends LedgerException {

    public function __construct($error = '')
    {
        $this->message = 'Unknown client type: ' . $error;
    }

} 