<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 20.07.2017
 * Time: 16:20
 */

namespace Core\Model;


use Core\Data\DataInterface;
use Core\Data\RegistryEntryData;

class RegistryEntry extends Model implements RegistryEntryInterface {

    static public $tableDescriptor = array(
        'registry_entries' => array(
            'alias' => 're',
            'keys' => array('registry_id','registry_entry_no'),
        ),
    );

    /**
     * @var RegistryInterface $registry
     */
    private $registry;
    /**
     * @var EntryInterface $entry
     */
    private $entry;

    /**
     * @return DataInterface[]
     */
    static public function createDataArray()
    {
        return array(new RegistryEntryData());
    }

    /**
     * @param int $part
     * @return \Core\Data\RegistryEntryDataInterface
     */
    protected function getData($part = 0) { return parent::getData($part); }

    /**
     * @return RegistryInterface
     */
    public function getRegistry()
    {
        if (is_null($this->registry) && !is_null($this->getData()->getRegistryId())) {

            $this->registry = $this->getStorage()->select('Core\Model\Registry', $this->getData()->getRegistryId());
        }

        return $this->registry;
    }

    /**
     * @return int
     */
    public function getNo()
    {
        return $this->getData()->getRegistryEntryNo();
    }

    /**
     * @return EntryInterface
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * @return int
     */
    public function getState()
    {
        return $this->getData()->getEntryState();
    }

    /**
     * @param RegistryInterface $registry
     * @return RegistryEntryInterface
     */
    public function setRegistry(RegistryInterface $registry)
    {
        $this->registry = $registry;

        if (!is_null($registry)) {
            $this->getData()->setRegistryId($registry->getId());
        }

        return $this;
    }

    /**
     * @param int $no
     * @return RegistryEntryInterface
     */
    public function setNo($no)
    {
        $this->getData()->setRegistryEntryNo($no);
        return $this;
    }

    /**
     * @param EntryInterface $entry
     * @return RegistryEntryInterface
     */
    public function setEntry(EntryInterface $entry)
    {
        $this->entry = $entry;

        if (!is_null($entry)) {
            $this->getData()->setRegistryId($entry->getId());
        }

        return $this;
    }

    /**
     * @param int $state
     * @return RegistryEntryInterface
     */
    public function setState($state)
    {
        $this->getData()->setEntryState($state);
        return $this;
    }
}