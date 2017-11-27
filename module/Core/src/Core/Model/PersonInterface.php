<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 14.07.2017
 * Time: 13:07
 */

namespace Core\Model;


interface PersonInterface extends ClientInterface {

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
     * @param string $name
     * @return PersonInterface
     */
    public function setLastName($name);

    /**
     * @param string $name
     * @return PersonInterface
     */
    public function setFirstName($name);

    /**
     * @param string $name
     * @return PersonInterface
     */
    public function setPatronymic($name);

    /**
     * @param string $sex
     * @return PersonInterface
     */
    public function setSex($sex);

    /**
     * @param string $day
     * @return PersonInterface
     */
    public function setBirthday($day);

    /**
     * @param string $place
     * @return PersonInterface
     */
    public function setBirthplace($place);

    /**
     * @param PersonPassportInterface $passport
     * @return PersonInterface
     */
    public function addPassport(PersonPassportInterface $passport);
} 