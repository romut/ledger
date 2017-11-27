<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 14.07.2017
 * Time: 19:06
 */

namespace Core\Model;


use Core\Data\DataInterface;
use Core\Data\PersonPassportData;

class PersonPassport extends Model implements PersonPassportInterface {

    static public $tableDescriptor = array(
        'person_passports' => array(
            'alias' => 'pp',
            'keys' => array('passport_type','passport_series','passport_id'),
        ),
    );

    /**
     * @return DataInterface[]
     */
    static public function createDataArray()
    {
        return array(new PersonPassportData());
    }

    /**
     * @param int $part
     * @return \Core\Data\PersonPassportDataInterface
     */
    protected function getData($part = 0) { return parent::getData($part); }

    /**
     * @return string
     */
    public function getPassportState()
    {
        return $this->getData()->getPassportState();
    }

    /**
     * @return string
     */
    public function getPassportType()
    {
        return $this->getData()->getPassportType();
    }

    /**
     * @return string
     */
    public function getPassportSeries()
    {
        return $this->getData()->getPassportSeries();
    }

    /**
     * @return string
     */
    public function getPassportId()
    {
        return $this->getData()->getPassportId();
    }

    /**
     * @return string
     */
    public function getPassportDate()
    {
        return self::fromDBDate($this->getData()->getPassportDate());
    }

    /**
     * @return string
     */
    public function getPassportPlace()
    {
        return $this->getData()->getPassportPlace();
    }

    public function setPersonId($id)
    {
        $this->getData()->setPersonId($id);
        return $this;
    }

    /**
     * @param string $state
     * @return PersonPassportInterface
     */
    public function setPassportState($state)
    {
        $this->getData()->setPassportState($state);
        return $this;
    }

    /**
     * @param string $type
     * @return PersonPassportInterface
     */
    public function setPassportType($type)
    {
        $this->getData()->setPassportType($type);
        return $this;
    }

    /**
     * @param string $series
     * @return PersonPassportInterface
     */
    public function setPassportSeries($series)
    {
        $this->getData()->setPassportSeries($series);
        return $this;
    }

    /**
     * @param string $id
     * @return PersonPassportInterface
     */
    public function setPassportId($id)
    {
        $this->getData()->setPassportId($id);
        return $this;
    }

    /**
     * @param string $date
     * @return PersonPassportInterface
     */
    public function setPassportDate($date)
    {
        $this->getData()->setPassportDate(self::toDBDate($date));
        return $this;
    }

    /**
     * @param string $place
     * @return PersonPassportInterface
     */
    public function setPassportPlace($place)
    {
        $this->getData()->setPassportPlace($place);
        return $this;
    }
}