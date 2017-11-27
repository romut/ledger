<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 17.06.2016
 * Time: 13:16
 */

namespace Core\Data;


class FolderEntryData extends Data implements FolderEntryDataInterface {

    protected $folderId;
    protected $entryId;

    public function getFolderId() { return $this->folderId; }
    public function getEntryId() { return $this->entryId; }

    public function setFolderId($id)
    {
        $this->folderId = $id;
        $this->modify();
        return $this;
    }

    public function setEntryId($id)
    {
        $this->entryId = $id;
        $this->modify();
        return $this;
    }
}