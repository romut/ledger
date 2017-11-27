<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 06.10.2016
 * Time: 20:51
 */

namespace Card\Model;


use Core\Model\BookChapter;
use Core\Model\FileInterface;

class BankCardChapter extends BookChapter implements BankCardChapterInterface {

    public function checkFile(FileInterface $file)
    {
        print "BankCardChapter check file\n";

        return $this;
    }
}