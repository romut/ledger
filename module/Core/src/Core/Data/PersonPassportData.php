<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 14.07.2017
 * Time: 18:31
 */

namespace Core\Data;


class PersonPassportData extends Data implements PersonPassportDataInterface {

    private $personId;
    private $state;
    private $type, $series, $id;
    private $date, $place;
    /**
     * @return int
     */
    public function getPersonId()
    {
        return $this->personId;
    }

    /**
     * @return string
     */
    public function getPassportState()
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getPassportType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getPassportSeries()
    {
        return $this->series;
    }

    /**
     * @return string
     */
    public function getPassportId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPassportDate()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getPassportPlace()
    {
        return $this->place;
    }

    /**
     * @param int $id
     * @return PersonPassportDataInterface
     */
    public function setPersonId($id)
    {
        $this->set($this->personId, $id);
        return $this;
    }

    /**
     * @param string $state
     * @return PersonPassportDataInterface
     */
    public function setPassportState($state)
    {
        $this->set($this->state, $state);
        return $this;
    }

    /**
     * @param string $type
     * @return PersonPassportDataInterface
     */
    public function setPassportType($type)
    {
        $this->set($this->type, $type);
        return $this;
    }

    /**
     * @param string $series
     * @return PersonPassportDataInterface
     */
    public function setPassportSeries($series)
    {
        $this->set($this->series, $series);
        return $this;
    }

    /**
     * @param string $id
     * @return PersonPassportDataInterface
     */
    public function setPassportId($id)
    {
        $this->set($this->id, $id);
        return $this;
    }

    /**
     * @param string $date
     * @return PersonPassportDataInterface
     */
    public function setPassportDate($date)
    {
        $this->set($this->date, $date);
        return $this;
    }

    /**
     * @param string $place
     * @return PersonPassportDataInterface
     */
    public function setPassportPlace($place)
    {
        $this->set($this->place, $place);
        return $this;
    }
}