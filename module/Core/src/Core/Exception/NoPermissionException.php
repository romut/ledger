<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 23.06.2016
 * Time: 9:21
 */

namespace Core\Exception;


class NoPermissionException extends LedgerException {

    protected $message = 'No permission';
} 