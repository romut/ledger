<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 13.01.2017
 * Time: 14:59
 */

namespace Core\Model;


use Core\Data\ClientFileMapData;

class ClientFileMap extends Model implements ClientFileMapInterface {

    static public $tableDescriptor =  array(
        'client_file_maps' => array(
            'alias' => 'cfm',
            'keys' => array('client_id', 'file_type_id'),
        ),
    );

    static public function createDataArray() { return array(new ClientFileMapData()); }

    private $fileType;
    private $fileMap;

    /**
     * @param int $part
     * @return \Core\Data\ClientFileMapDataInterface
     */
    protected function getData($part = 0) { return parent::getData($part); }

    /**
     * @return FileTypeInterface
     */
    public function getFileType()
    {
        if (is_null($this->fileType) && !is_null($this->getData()->getFileTypeId())) {

            $this->fileType = $this->getStorage()->select(
                'FileType',
                array('id' => $this->getData()->getFileTypeId())
            );
        }

        return $this->fileType;
    }

    /**
     * @return FileMapInterface
     */
    public function getFileMap()
    {
        if (is_null($this->fileMap) && !is_null($this->getData()->getFileMapId())) {

            $this->fileMap = $this->getStorage()->select(
                'FileMap',
                array('id' => $this->getData()->getFileMapId()
            ));
        }

        return $this->fileType;
    }

    /**
     * @param FileTypeInterface $fileType
     * @return ClientFileMapInterface
     */
    public function setFileType(FileTypeInterface $fileType)
    {
        $this->fileType = $fileType;
        $this->getData()->setFileTypeId($fileType->getId());

        return $this;
    }

    /**
     * @param FileMapInterface $fileMap
     * @return ClientFileMapInterface
     */
    public function setFileMap(FileMapInterface $fileMap)
    {
        $this->fileMap = $fileMap;
        $this->getData()->setFileMapId($fileMap->getId());

        return $this;
    }
}