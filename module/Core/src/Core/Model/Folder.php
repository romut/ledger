<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 16.06.2016
 * Time: 18:06
 */

namespace Core\Model;

use Core\Data\EntryData;
use Core\Data\EntryDataInterface;
use Core\Data\FolderData;
use Core\Data\FolderDataInterface;

class Folder extends Entry implements FolderInterface {

    static public $tableDescriptor = array(
        'entries' => array(
            'alias' => 'e',
            'keys' => array('id'),
            'auto_increment' => 'id',
        ),
        'folders' => array(
            'alias' => 'f',
            'keys' => array('folder_id'),
            'relation' => array(
                'master_alias' => 'e',
                'master_key' => 'id',
                'slave_key' => 'folder_id'
            ),
        ),
    );

    static public function createDataArray()
    {
        return array(new EntryData(), new FolderData());
    }

    /**
     * @param int $part
     * @return EntryDataInterface|FolderDataInterface
     */
    protected function getData($part = 0) { return parent::getData($part); }
}