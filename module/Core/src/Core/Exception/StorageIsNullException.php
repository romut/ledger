<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 06.09.2016
 * Time: 18:38
 */

namespace Core\Exception;


class StorageIsNullException extends LedgerException {

    protected $message = 'Storage not defined for this model';
} 