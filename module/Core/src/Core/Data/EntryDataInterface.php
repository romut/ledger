<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 24.05.2016
 * Time: 15:15
 */

namespace Core\Data;


interface EntryDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getEntryId();

    /**
     * @return int
     */
    public function getModelId();

    /**
     * @return int
     */
    public function getParentId();

    /**
     * @return int
     */
    public function getEntryState();

    /**
     * @param int $id
     * @return EntryDataInterface
     */
    public function setEntryId($id);

    /**
     * @param int $id
     * @return EntryDataInterface
     */
    public function setParentId($id);

    /**
     * @param int $id
     * @return EntryDataInterface
     */
    public function setModelId($id);

    /**
     * @param int $state
     * @return EntryDataInterface
     */
    public function setEntryState($state);
}