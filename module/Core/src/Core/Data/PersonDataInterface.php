<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 14.07.2017
 * Time: 12:55
 */

namespace Core\Data;


interface PersonDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getPersonId();

    /**
     * @return string
     */
    public function getLastName();

    /**
     * @return string
     */
    public function getFirstName();

    /**
     * @return string
     */
    public function getPatronymic();

    /**
     * @return string
     */
    public function getSex();

    /**
     * @return string
     */
    public function getBirthday();

    /**
     * @return string
     */
    public function getBirthplace();

    /**
     * @param int $id
     * @return PersonDataInterface
     */
    public function setPersonId($id);

    /**
     * @param string $name
     * @return PersonDataInterface
     */
    public function setLastName($name);

    /**
     * @param string $name
     * @return PersonDataInterface
     */
    public function setFirstName($name);

    /**
     * @param string $name
     * @return PersonDataInterface
     */
    public function setPatronymic($name);

    /**
     * @param string $sex
     * @return PersonDataInterface
     */
    public function setSex($sex);

    /**
     * @param string $day
     * @return PersonDataInterface
     */
    public function setBirthday($day);

    /**
     * @param string $place
     * @return PersonDataInterface
     */
    public function setBirthplace($place);
} 