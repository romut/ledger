<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 27.01.2017
 * Time: 10:42
 */

namespace Core\Exception;


class DataArrayNotDefinedException extends LedgerException {

    protected $message = 'Data array not defined for this model';
} 