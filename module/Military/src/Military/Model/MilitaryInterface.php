<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 21.07.2017
 * Time: 15:52
 */

namespace Military\Model;


use Core\Model\PersonInterface;

interface MilitaryInterface extends PersonInterface {

    /**
     * @return string
     */
    public function getNumber();

    /**
     * @return int
     */
    public function getState();

    /**
     * @param string $number
     * @return MilitaryInterface
     */
    public function setNumber($number);

    /**
     * @param int $state
     * @return MilitaryInterface
     */
    public function setState($state);

} 