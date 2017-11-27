<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 14.07.2017
 * Time: 13:01
 */

namespace Core\Data;


class PersonData extends Data implements PersonDataInterface {

    private $id;
    private $lastName, $firstName, $patronymic;
    private $sex, $birthday, $birthplace;

    /**
     * @return int
     */
    public function getPersonId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getPatronymic()
    {
        return $this->patronymic;
    }

    /**
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @return string
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @return string
     */
    public function getBirthplace()
    {
        return $this->birthplace;
    }

    /**
     * @param int $id
     * @return PersonDataInterface
     */
    public function setPersonId($id)
    {
        $this->set($this->id, $id);
        return $this;
    }

    /**
     * @param string $name
     * @return PersonDataInterface
     */
    public function setLastName($name)
    {
        $this->set($this->lastName, $name);
        return $this;
    }

    /**
     * @param string $name
     * @return PersonDataInterface
     */
    public function setFirstName($name)
    {
        $this->set($this->firstName, $name);
        return $this;
    }

    /**
     * @param string $name
     * @return PersonDataInterface
     */
    public function setPatronymic($name)
    {
        $this->set($this->patronymic, $name);
        return $this;
    }

    /**
     * @param string $sex
     * @return PersonDataInterface
     */
    public function setSex($sex)
    {
        $this->set($this->sex, $sex);
        return $this;
    }

    /**
     * @param string $day
     * @return PersonDataInterface
     */
    public function setBirthday($day)
    {
        $this->set($this->birthday, $day);
        return $this;
    }

    /**
     * @param string $place
     * @return PersonDataInterface
     */
    public function setBirthplace($place)
    {
        $this->set($this->birthplace, $place);
        return $this;
    }
}