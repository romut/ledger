<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 21.07.2017
 * Time: 15:50
 */

namespace Military\Data;


use Core\Data\Data;

class MilitaryData extends Data implements MilitaryDataInterface {

    private $id, $state, $number;

    /**
     * @return int
     */
    public function getMilitaryId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getMilitaryState()
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getMilitaryNumber()
    {
        return $this->number;
    }

    /**
     * @param int $id
     * @return MilitaryDataInterface
     */
    public function setMilitaryId($id)
    {
        $this->set($this->id, $id);
        return $this;
    }

    /**
     * @param string $state
     * @return MilitaryDataInterface
     */
    public function setMilitaryState($state)
    {
        $this->set($this->state, $state);
        return $this;
    }

    /**
     * @param int $number
     * @return MilitaryDataInterface
     */
    public function setMilitaryNumber($number)
    {
        $this->set($this->number, $number);
        return $this;
    }
}