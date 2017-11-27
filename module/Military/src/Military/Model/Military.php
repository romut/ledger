<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 21.07.2017
 * Time: 15:56
 */

namespace Military\Model;


use Core\Data\ClientData;
use Core\Data\EntryData;
use Core\Data\PersonData;
use Core\Model\Person;
use Military\Data\MilitaryData;

class Military extends Person implements MilitaryInterface {

    static public $tableDescriptor = array(
        'entries' => array(
            'alias' => 'e',
            'keys' => array('entry_id'),
            'auto_increment' => 'entry_id',
        ),
        'clients' => array(
            'alias' => 'c',
            'keys' => array('client_id'),
            'relation' => array(
                'master_alias' => 'e',
                'master_key' => 'entry_id',
                'slave_key' => 'client_id'
            ),
        ),
        'persons' => array(
            'alias' => 'p',
            'keys' => array('person_id'),
            'relation' => array(
                'master_alias' => 'e',
                'master_key' => 'entry_id',
                'slave_key' => 'person_id'
            ),
        ),
        'military' => array(
            'alias' => 'm',
            'keys' => array('military_id'),
            'relation' => array(
                'master_alias' => 'e',
                'master_key' => 'entry_id',
                'slave_key' => 'military_id'
            ),
        ),
    );

    static public function createDataArray()
    {
        return array(
            new EntryData(),
            new ClientData(),
            new PersonData(),
            new MilitaryData()
        );
    }

    /**
     * @param int $part
     * @return \Core\Data\EntryDataInterface|\Core\Data\ClientDataInterface|\Core\Data\PersonDataInterface|\Military\Data\MilitaryDataInterface
     */
    protected function getData($part = 0) { return parent::getData($part); }

    /**
     * @param int $part
     * @return \Core\Data\EntryDataInterface|\Core\Data\ClientDataInterface|\Core\Data\PersonDataInterface|\Military\Data\MilitaryDataInterface
     */
    protected function setData($part = 0) { return parent::setData($part); }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->getData(3)->getMilitaryNumber();
    }

    /**
     * @return int
     */
    public function getState()
    {
        return $this->getData(3)->getMilitaryState();
    }

    /**
     * @param string $number
     * @return MilitaryInterface
     */
    public function setNumber($number)
    {
        $this->setData(3)->setMilitaryNumber($number);
        return $this;
    }

    /**
     * @param int $state
     * @return MilitaryInterface
     */
    public function setState($state)
    {
        $this->setData(3)->setMilitaryState($state);
        return $this;
    }
}