<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 29.03.2017
 * Time: 13:40
 */

namespace Core\Exception;


class UnknownFileTypeException extends LedgerException {

    public function __construct($fileName = '')
    {
        $this->message = 'Unknown type of file ' . $fileName;
    }
} 