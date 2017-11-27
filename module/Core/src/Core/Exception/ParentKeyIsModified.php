<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 29.03.2017
 * Time: 11:20
 */

namespace Core\Exception;


class ParentKeyIsModified extends LedgerException {

    protected $message = 'Parent row is modified';
} 