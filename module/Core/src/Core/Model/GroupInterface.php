<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 02.02.2016
 * Time: 22:34
 */

namespace Core\Model;


interface GroupInterface extends EntryInterface {

    /**
     * @param string $name
     * @return GroupInterface
     */
    public function setName($name);
}