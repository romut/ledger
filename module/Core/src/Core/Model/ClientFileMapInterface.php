<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 13.01.2017
 * Time: 14:49
 */

namespace Core\Model;


interface ClientFileMapInterface extends ModelInterface {

    /**
     * @return FileTypeInterface
     */
    public function getFileType();

    /**
     * @return FileMapInterface
     */
    public function getFileMap();

    /**
     * @param FileTypeInterface $fileType
     * @return ClientFileMapInterface
     */
    public function setFileType(FileTypeInterface $fileType);

    /**
     * @param FileMapInterface $fileMap
     * @return ClientFileMapInterface
     */
    public function setFileMap(FileMapInterface $fileMap);
} 