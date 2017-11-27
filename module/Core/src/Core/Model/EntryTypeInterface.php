<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 01.02.2017
 * Time: 17:06
 */

namespace Core\Model;


interface EntryTypeInterface extends ModelInterface {

    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return EntryTypeInterface
     */
    public function setName($name);

} 