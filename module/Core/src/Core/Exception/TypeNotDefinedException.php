<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 23.01.2017
 * Time: 18:31
 */

namespace Core\Exception;


class TypeNotDefinedException extends LedgerException {

    protected $message = 'Type not defined for this model';
} 