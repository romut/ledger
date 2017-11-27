<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 20.07.2017
 * Time: 12:29
 */

namespace Military\Data;


use Core\Data\Data;

class RegistryPersonData extends Data implements RegistryPersonDataInterface {

    private $registryId, $registryPersonNo, $registryPersonState;
    private $personId, $personNumber, $personBankId, $personAccount;

    /**
     * @return int
     */
    public function getMilitaryRegistryId()
    {
        return $this->registryId;
    }

    /**
     * @return int
     */
    public function getPersonRegistryNo()
    {
        return $this->registryPersonNo;
    }

    /**
     * @return int
     */
    public function getPersonRegistryState()
    {
        return $this->registryPersonState;
    }

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
    public function getPersonNumber()
    {
        return $this->personNumber;
    }

    /**
     * @return string
     */
    public function getPersonBankId()
    {
        return $this->personBankId;
    }

    /**
     * @return string
     */
    public function getPersonAccount()
    {
        return $this->personAccount;
    }

    /**
     * @param int $id
     * @return RegistryPersonDataInterface
     */
    public function setMilitaryRegistryId($id)
    {
        $this->set($this->registryId, $id);
        return $this;
    }

    /**
     * @param int $no
     * @return RegistryPersonDataInterface
     */
    public function setPersonRegistryNo($no)
    {
        $this->set($this->registryPersonNo, $no);
        return $this;
    }

    /**
     * @param int $state
     * @return RegistryPersonDataInterface
     */
    public function setPersonRegistryState($state)
    {
        $this->set($this->registryPersonState, $state);
        return $this;
    }

    /**
     * @param int $id
     * @return RegistryPersonDataInterface
     */
    public function setPersonId($id)
    {
        $this->set($this->personId, $id);
        return $this;

    }

    /**
     * @param string $number
     * @return RegistryPersonDataInterface
     */
    public function setPersonNumber($number)
    {
        $this->set($this->personNumber, $number);
        return $this;
    }

    /**
     * @param string $id
     * @return RegistryPersonDataInterface
     */
    public function setPersonBankId($id)
    {
        $this->set($this->personBankId, $id);
        return $this;
    }

    /**
     * @param string $account
     * @return RegistryPersonDataInterface
     */
    public function setPersonAccount($account)
    {
        $this->set($this->personAccount, $account);
        return $this;
    }
}