<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 02.02.2017
 * Time: 19:32
 */

namespace Core\Exception;


class UnknownEntryTypeException extends LedgerException {

    protected $message = 'Unknown entry type';
} 