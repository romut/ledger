<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 14.07.2017
 * Time: 19:03
 */

namespace Core\Model;

interface PersonPassportInterface extends ModelInterface {

    /**
     * @return string
     */
    public function getPassportState();

    /**
     * @return string
     */
    public function getPassportType();

    /**
     * @return string
     */
    public function getPassportSeries();

    /**
     * @return string
     */
    public function getPassportId();

    /**
     * @return string
     */
    public function getPassportDate();

    /**
     * @return string
     */
    public function getPassportPlace();

    /**
     * @param int $id
     * @return PersonPassportInterface
     */
    public function setPersonId($id);

    /**
     * @param string $state
     * @return PersonPassportInterface
     */
    public function setPassportState($state);

    /**
     * @param string $type
     * @return PersonPassportInterface
     */
    public function setPassportType($type);

    /**
     * @param string $series
     * @return PersonPassportInterface
     */
    public function setPassportSeries($series);

    /**
     * @param string $id
     * @return PersonPassportInterface
     */
    public function setPassportId($id);

    /**
     * @param string $date
     * @return PersonPassportInterface
     */
    public function setPassportDate($date);

    /**
     * @param string $place
     * @return PersonPassportInterface
     */
    public function setPassportPlace($place);
} 