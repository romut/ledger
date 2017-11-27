<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 14.07.2017
 * Time: 16:02
 */

namespace Core\Model;

interface ClientTypeInterface extends ModelInterface {

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
     * @return string
     */
    public function setName($name);

} 