<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 22.06.2016
 * Time: 17:48
 */

namespace Core\Exception;


class BookIsNullException extends LedgerException {

    protected $message = 'Book in not set';
} 