<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 30.01.2017
 * Time: 10:44
 */

namespace Core\Exception;


class TableDescriptorNotDefinedException extends LedgerException {

    protected $message = 'Table descriptor not defined';
} 