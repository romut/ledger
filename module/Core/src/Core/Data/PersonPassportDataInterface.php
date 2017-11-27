<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 14.07.2017
 * Time: 18:10
 */

namespace Core\Data;


interface PersonPassportDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getPersonId();

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
     * @return PersonPassportDataInterface
     */
    public function setPersonId($id);

    /**
     * @param string $state
     * @return PersonPassportDataInterface
     */
    public function setPassportState($state);

    /**
     * @param string $type
     * @return PersonPassportDataInterface
     */
    public function setPassportType($type);

    /**
     * @param string $series
     * @return PersonPassportDataInterface
     */
    public function setPassportSeries($series);

    /**
     * @param string $id
     * @return PersonPassportDataInterface
     */
    public function setPassportId($id);

    /**
     * @param string $date
     * @return PersonPassportDataInterface
     */
    public function setPassportDate($date);

    /**
     * @param string $place
     * @return PersonPassportDataInterface
     */
    public function setPassportPlace($place);
}