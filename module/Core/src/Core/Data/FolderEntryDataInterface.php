<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 17.06.2016
 * Time: 13:16
 */

namespace Core\Data;


interface FolderEntryDataInterface extends DataInterface {

    public function getFolderId();
    public function getEntryId();

    public function setFolderId($id);
    public function setEntryId($id);
} 