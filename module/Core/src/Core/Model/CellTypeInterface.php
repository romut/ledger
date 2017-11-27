<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 19.01.2017
 * Time: 18:27
 */

namespace Core\Model;


interface CellTypeInterface extends ModelInterface {

    public function validate($value);
} 