<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 20.07.2017
 * Time: 12:59
 */

namespace Military\Model;


use Core\Data\DataInterface;
use Core\Model\Model;
use Core\Model\PersonInterface;
use Military\Data\RegistryPersonData;

class RegistryPerson extends Model implements RegistryPersonInterface {

    /**
     * @var RegistryInterface $registry
     */
    private $registry;
    /**
     * @var PersonInterface $person
     */
    private $person;

    static public $tableDescriptor = array(
        'military_registry_persons' => array(
            'alias' => 'mrp',
            'keys' => array('military_registry_id','person_registry_no'),
        ),
    );

    /**
     * @return DataInterface[]
     */
    static public function createDataArray()
    {
        return array(new RegistryPersonData());
    }

    /**
     * @param int $part
     * @return \Military\Data\RegistryPersonDataInterface
     */
    protected function getData($part = 0) { return parent::getData($part); }

    /**
     * @return RegistryInterface
     */
    public function getRegistry()
    {
        return $this->registry;
    }

    /**
     * @return PersonInterface
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @return int
     */
    public function getState()
    {
        return $this->getData()->getPersonRegistryState();
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->getData()->getPersonNumber();
    }

    /**
     * @return string
     */
    public function getBankId()
    {
        return $this->getData()->getPersonBankId();
    }

    /**
     * @return string
     */
    public function getAccount()
    {
        return $this->getData()->getPersonAccount();
    }

    /**
     * @param RegistryInterface $registry
     * @return RegistryPersonInterface
     */
    public function setRegistry(RegistryInterface $registry)
    {
        $this->registry = $registry;
        $this->getData()->setMilitaryRegistryId($registry->getId());
        return $this;
    }

    /**
     * @param PersonInterface $person
     * @return RegistryPersonInterface
     */
    public function setPerson(PersonInterface $person)
    {
        $this->person = $person;
        $this->getData()->setPersonId($person->getId());
        return $this;
    }

    /**
     * @param int $state
     * @return RegistryPersonInterface
     */
    public function setState($state)
    {
        $this->getData()->setPersonRegistryState($state);
        return $this;
    }

    /**
     * @param string $number
     * @return RegistryPersonInterface
     */
    public function setNumber($number)
    {
        $this->getData()->setPersonNumber($number);
        return $this;
    }

    /**
     * @param string $id
     * @return RegistryPersonInterface
     */
    public function setBankId($id)
    {
        $this->getData()->setPersonBankId($id);
        return $this;
    }

    /**
     * @param string $account
     * @return RegistryPersonInterface
     */
    public function setAccount($account)
    {
        $this->getData()->setPersonAccount($account);
        return $this;
    }
}