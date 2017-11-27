<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 13.01.2017
 * Time: 11:44
 */

namespace Core\Model;


interface FileMapInterface extends ModelInterface, \ArrayAccess {

    public function getId();
}