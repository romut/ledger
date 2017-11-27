<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 20.07.2017
 * Time: 16:07
 */

namespace Core\Data;


interface RegistryDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getRegistryId();

    /**
     * @return int
     */
    public function getRegistryState();

    /**
     * @return int
     */
    public function getRegistryEntryCount();

    /**
     * @return int
     */
    public function getFileId();

    /**
     * @param int $id
     * @return RegistryDataInterface
     */
    public function setRegistryId($id);

    /**
     * @param int $state
     * @return RegistryDataInterface
     */
    public function setRegistryState($state);

    /**
     * @param int $count
     * @return RegistryDataInterface
     */
    public function setRegistryEntryCount($count);

    /**
     * @param int $id
     * @return RegistryDataInterface
     */
    public function setFileId($id);
}