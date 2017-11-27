<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 06.07.2016
 * Time: 14:59
 */

namespace Core\Exception;


class NotAuthenticatedException extends LedgerException {

    protected $message = 'User not authenticated';
} 