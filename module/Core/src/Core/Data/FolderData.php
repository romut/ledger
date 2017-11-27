<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 15.06.2016
 * Time: 19:49
 */

namespace Core\Data;


class FolderData extends Data implements FolderDataInterface {

    protected $folderId;
    protected $name;
    protected $description;

    public function getFolderId()
    {
        return $this->folderId;
    }

    public function getFolderName()
    {
        return $this->name;
    }

    public function setFolderId($id)
    {
        $this->set($this->folderId, $id);
        return $this;
    }

    public function setFolderName($name)
    {
        $this->set($this->name, $name);
        return $this;
    }
    
    public function setFolderDescription($description)
    {
        $this->set($this->description, $description);
        return $this;
    }

    public function getFolderDescription()
    {
        return $this->description;
    }

}