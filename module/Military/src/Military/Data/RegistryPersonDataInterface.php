<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 20.07.2017
 * Time: 12:18
 */

namespace Military\Data;


use Core\Data\DataInterface;

interface RegistryPersonDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getMilitaryRegistryId();

    /**
     * @return int
     */
    public function getPersonRegistryNo();

    /**
     * @return int
     */
    public function getPersonRegistryState();

    /**
     * @return int
     */
    public function getPersonId();

    /**
     * @return string
     */
    public function getPersonNumber();

    /**
     * @return string
     */
    public function getPersonBankId();

    /**
     * @return string
     */
    public function getPersonAccount();

    /**
     * @param int $id
     * @return RegistryPersonDataInterface
     */
    public function setMilitaryRegistryId($id);

    /**
     * @param int $no
     * @return RegistryPersonDataInterface
     */
    public function setPersonRegistryNo($no);

    /**
     * @param int $state
     * @return RegistryPersonDataInterface
     */
    public function setPersonRegistryState($state);

    /**
     * @param int $id
     * @return RegistryPersonDataInterface
     */
    public function setPersonId($id);

    /**
     * @param string $number
     * @return RegistryPersonDataInterface
     */
    public function setPersonNumber($number);

    /**
     * @param string $id
     * @return RegistryPersonDataInterface
     */
    public function setPersonBankId($id);

    /**
     * @param string $account
     * @return RegistryPersonDataInterface
     */
    public function setPersonAccount($account);
}