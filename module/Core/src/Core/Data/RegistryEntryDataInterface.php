<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 20.07.2017
 * Time: 15:37
 */

namespace Core\Data;


interface RegistryEntryDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getRegistryId();

    /**
     * @return int
     */
    public function getRegistryEntryNo();

    /**
     * @return int
     */
    public function getEntryId();

    /**
     * @return int
     */
    public function getEntryState();

    /**
     * @param int $id
     * @return RegistryEntryDataInterface
     */
    public function setRegistryId($id);

    /**
     * @param int $no
     * @return RegistryEntryDataInterface
     */
    public function setRegistryEntryNo($no);

    /**
     * @param int $id
     * @return RegistryEntryDataInterface
     */
    public function setEntryId($id);

    /**
     * @param int $state
     * @return RegistryEntryDataInterface
     */
    public function setEntryState($state);
} 