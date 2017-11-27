<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 18.01.2017
 * Time: 19:38
 */

namespace Core\Model;


use Core\Data\ClientData;
use Core\Data\ClientDataInterface;
use Core\Data\EntryData;

class Client extends Entry implements ClientInterface {

    static public $tableDescriptor = array(
        'entries' => array(
            'alias' => 'e',
            'keys' => array('entry_id'),
            'auto_increment' => 'entry_id',
        ),
        'clients' => array(
            'alias' => 'c',
            'keys' => array('client_id'),
            'relation' => array(
                'master_alias' => 'e',
                'master_key' => 'entry_id',
                'slave_key' => 'client_id'
            ),
        ),
    );

    static public function createDataArray() { return array(new EntryData(), new ClientData()); }

    /**
     * @var FileMapInterface $fileMaps;
     */
    private $fileMaps = array();

    /**
     * @var ClientAccountInterface[] $accounts
     */
    private $accounts = array();

    /**
     * @param int $part
     * @return ClientDataInterface
     */
    protected function getData($part = 0) { return parent::getData($part); }

    /**
     * @param int $part
     * @return ClientDataInterface
     */
    protected function setData($part = 0) { return parent::setData($part); }

    protected function afterSave()
    {
        foreach ($this->accounts as $account) {

            $account->setClient($this);
            $account->save();
        }
    }

    /**
     * @param FileTypeInterface $fileType
     * @return ModelInterface|FileMapInterface
     */
    public function getFileMap(FileTypeInterface $fileType)
    {
        if (isset($this->fileMaps[$fileType->getId()])) return $this->fileMaps[$fileType->getId()];

        /**
         * @var ClientFileMapInterface $clientFileMap
         */
        $clientFileMap = $this->getStorage()->select(
            'Core\Model\ClientFileMap',
            array(
                'client_id' => $this->getId(),
                'file_type_id' => $fileType->getId()
            )
        );

        $fileMap = is_null($clientFileMap) ?
            $this->getStorage()->createModel('Core\Model\FileMap') :
            $clientFileMap->getFileMap();

        $this->fileMaps[$fileType->getId()] = $fileMap;

        return $fileMap;
    }

    /**
     * @param FileTypeInterface $fileType
     * @param FileMapInterface $fileMap
     * @return $this|CompanyInterface
     */
    public function setFileMap(FileTypeInterface $fileType, FileMapInterface $fileMap)
    {
        $this->fileMaps[$fileType->getId()] = $fileMap;
        return $this;
    }

    public function addAccount(ClientAccountInterface $account)
    {
        $this->accounts[] = $account;

        return $this;
    }
}