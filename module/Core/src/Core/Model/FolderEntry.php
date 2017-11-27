<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 17.06.2016
 * Time: 13:26
 */

namespace Core\Model;


use Core\Data\EntryData;
use Core\Data\FolderData;
use Core\Data\FolderEntryData;

class FolderEntry extends Folder implements FolderEntryInterface {

    public function __construct(BookInterface $book = null, $data = null)
    {
        parent::__construct(
            $book,
            is_null($data) ? array(
                new EntryData(), new FolderData(), new FolderEntryData()
            ) : $data);
    }
} 