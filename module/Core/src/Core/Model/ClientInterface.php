<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 18.01.2017
 * Time: 19:28
 */

namespace Core\Model;


interface ClientInterface extends EntryInterface {

    /**
     * @param FileTypeInterface $fileType
     * @return FileMapInterface
     */
    public function getFileMap(FileTypeInterface $fileType);

    /**
     * @param FileTypeInterface $fileType
     * @param FileMapInterface $fileMap
     * @return CompanyInterface
     */
    public function setFileMap(FileTypeInterface $fileType, FileMapInterface $fileMap);

    /**
     * @param ClientAccountInterface $account
     * @return ClientInterface
     */
    public function addAccount(ClientAccountInterface $account);
}