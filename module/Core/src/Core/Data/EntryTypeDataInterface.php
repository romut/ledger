<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 01.02.2017
 * Time: 17:02
 */

namespace Core\Data;


interface EntryTypeDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getEntryTypeId();

    /**
     * @return string
     */
    public function getEntryTypeName();

    /**
     * @return int
     */
    public function getModelId();

    /**
     * @param int $id
     * @return EntryTypeDataInterface
     */
    public function setEntryTypeId($id);

    /**
     * @param string $name
     * @return EntryTypeDataInterface
     */
    public function setEntryTypeName($name);

    /**
     * @param int $id
     * @return EntryTypeDataInterface
     */
    public function setModelId($id);
} 