<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 27.01.2017
 * Time: 11:14
 */

namespace Core\Exception;


class ModelTypeNotDefinedException extends LedgerException {

    protected $message = 'Unknown model type';
} 