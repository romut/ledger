<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 15.06.2016
 * Time: 19:47
 */

namespace Core\Data;


interface FolderDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getFolderId();

    /**
     * @return string
     */
    public function getFolderName();

    /**
     * @return string
     */
    public function getFolderDescription();

    /**
     * @param int $id
     * @return FolderDataInterface
     */
    public function setFolderId($id);

    /**
     * @param string $name
     * @return FolderDataInterface
     */
    public function setFolderName($name);

    /**
     * @param string $description
     * @return FolderDataInterface
     */
    public function setFolderDescription($description);
} 