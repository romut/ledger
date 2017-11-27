<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 20.07.2017
 * Time: 12:41
 */

namespace Military\Model;


use Core\Model\ModelInterface;
use Core\Model\PersonInterface;

interface RegistryPersonInterface extends ModelInterface {

    /**
     * @return RegistryInterface
     */
    public function getRegistry();

    /**
     * @return PersonInterface
     */
    public function getPerson();

    /**
     * @return int
     */
    public function getState();

    /**
     * @return string
     */
    public function getNumber();

    /**
     * @return string
     */
    public function getBankId();

    /**
     * @return string
     */
    public function getAccount();

    /**
     * @param RegistryInterface $registry
     * @return RegistryPersonInterface
     */
    public function setRegistry(RegistryInterface $registry);

    /**
     * @param PersonInterface $person
     * @return RegistryPersonInterface
     */
    public function setPerson(PersonInterface $person);

    /**
     * @param int $state
     * @return RegistryPersonInterface
     */
    public function setState($state);

    /**
     * @param string $number
     * @return RegistryPersonInterface
     */
    public function setNumber($number);

    /**
     * @param string $id
     * @return RegistryPersonInterface
     */
    public function setBankId($id);

    /**
     * @param string $account
     * @return RegistryPersonInterface
     */
    public function setAccount($account);
}