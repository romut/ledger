<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 21.07.2017
 * Time: 15:47
 */

namespace Military\Data;


use Core\Data\DataInterface;

interface MilitaryDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getMilitaryId();

    /**
     * @return int
     */
    public function getMilitaryState();

    /**
     * @return string
     */
    public function getMilitaryNumber();

    /**
     * @param int $id
     * @return MilitaryDataInterface
     */
    public function setMilitaryId($id);

    /**
     * @param int $state
     * @return MilitaryDataInterface
     */
    public function setMilitaryState($state);

    /**
     * @param string $number
     * @return MilitaryDataInterface
     */
    public function setMilitaryNumber($number);
} 