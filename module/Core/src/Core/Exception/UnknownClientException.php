<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 29.03.2017
 * Time: 16:02
 */

namespace Core\Exception;


class UnknownClientException extends LedgerException {

    public function __construct($error = '')
    {
        $this->message = 'Unknown client: ' . $error;
    }

} 