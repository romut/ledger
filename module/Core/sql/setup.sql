-- ----------------------------
-- Setup tables 
-- ----------------------------
INSERT INTO `ledger`.`field_types` (`field_type`,`class`,`size`,`precision`,`template`,`field_type_description`)
VALUES
('S',null,32,null,null,'Short name'),
('S',null,64,null,null,'Name'),
('S',null,126,null,null,'Long name'),
('S',null,256,null,null,'Description'),
('N',null,12,0,null,'Id'),
('N',null,15,2,null,'Amount'),
('D',null,null,null,null,'Date'),
('T',null,null,null,null,'Time'),
('DT',null,null,null,null,'DateTime')
;

INSERT INTO `ledger`.`models` (`model_class_name`) VALUES
('Core\\Model\\EntryType'),
('Core\\Model\\Folder'),
('Core\\Model\\FolderEntry'),
('Core\\Model\\User'),
('Core\\Model\\Group'),
('Core\\Model\\Book'),
('Core\\Model\\BookChapter'),
('Core\\Model\\CellType'),
('Core\\Model\\FileType'),
('Core\\Model\\FileTypeCell'),
('Core\\Model\\FileMap'),
('Core\\Model\\FileMapEntry'),
('Core\\Model\\ClientType'),
('Core\\Model\\Client'),
('Core\\Model\\ClientFileMap'),
('Core\\Model\\ClientAccount'),
('Core\\Model\\File'),
('Core\\Model\\FileCell'),
('Core\\Model\\FileError'),
('Core\\Model\\Company'),
('Core\\Model\\Person'),
('Core\\Model\\PersonPassport'),
('BankCard\\Model\\BankCardChapter'),
('Military\\Model\\MilitaryChapter'),
('Military\\Model\\Military')
;

INSERT INTO `ledger`.`entries` (`model_id`)
SELECT `model_id` FROM `ledger`.`models` WHERE `model_class_name` IN
(
'Core\\Model\\Folder',
'Core\\Model\\User',
'Core\\Model\\Group',
'Core\\Model\\Book',
'BankCard\\Model\\BankCardChapter',
'Military\\Model\\MilitaryChapter',
'Core\\Model\\File',
'Core\\Model\\Client',
'Core\\Model\\Company',
'Core\\Model\\Person',
'Military\\Model\\Military'
);

-- ------------

INSERT INTO `ledger`.`folders` (`folder_id`,`folder_name`) 
SELECT `entry_id`, '/' FROM `ledger`.`entries` `e`, `ledger`.`models` `m`
WHERE `m`.`model_class_name` = 'Core\\Model\\Folder' AND `m`.`model_id` = `e`.`model_id`;

INSERT INTO `ledger`.`users` (`user_id`,`login`,`password`) 
SELECT `entry_id`, 'root', 'romancho' FROM `ledger`.`entries` `e`, `ledger`.`models` `m`
WHERE `m`.`model_class_name` = 'Core\\Model\\User' AND `m`.`model_id` = `e`.`model_id`;

INSERT INTO `ledger`.`groups` (`group_id`,`group_name`) 
SELECT `entry_id`, 'admins' FROM `ledger`.`entries` `e`, `ledger`.`models` `m`
WHERE `m`.`model_class_name` = 'Core\\Model\\Group' AND `m`.`model_id` = `e`.`model_id`;

INSERT INTO `ledger`.`books` (`book_id`,`book_name`,`data_path`) 
SELECT `entry_id`, 'Main Book', 'd:/prj/php/zf2/Ledger/data' FROM `ledger`.`entries` `e`, `ledger`.`models` `m`
WHERE `m`.`model_class_name` = 'Core\\Model\\Book' AND `m`.`model_id` = `e`.`model_id`;

INSERT INTO `ledger`.`book_chapters` (`book_chapter_id`,`book_chapter_name`,`class`) 
SELECT `entry_id`, 'BankCardChapter', 'BankCard\\Model\\BankCardChapter'
FROM `ledger`.`entries` `e`, `ledger`.`models` `m`
WHERE `m`.`model_class_name` = 'BankCard\\Model\\BankCardChapter' AND `m`.`model_id` = `e`.`model_id`;

INSERT INTO `ledger`.`book_chapters` (`book_chapter_id`,`book_chapter_name`,`class`) 
SELECT `entry_id`, 'MilitaryChapter', 'Military\\Model\\MilitaryChapter'
FROM `ledger`.`entries` `e`, `ledger`.`models` `m`
WHERE `m`.`model_class_name` = 'Military\\Model\\MilitaryChapter' AND `m`.`model_id` = `e`.`model_id`;

INSERT INTO `ledger`.`file_types` (`book_chapter_id`,`file_type_name`,`file_name_pattern`)
SELECT `book_chapter_id`, 'Card Issue File', '(?i)^O'
FROM `ledger`.`book_chapters` WHERE `book_chapter_name` = 'BankCardChapter';

INSERT INTO `ledger`.`file_types` (`book_chapter_id`,`file_type_name`,`file_name_pattern`)
SELECT `book_chapter_id`, 'Military Register for ERC', '(?i)^Реестр_Хабаровск_(\\d){8}_\\d.xls?x'
FROM `ledger`.`book_chapters` WHERE `book_chapter_name` = 'MilitaryChapter';

INSERT INTO `ledger`.`client_types` (`client_type_name`) VALUES
('Company'),
('Person')
; 

INSERT INTO `ledger`.`clients` (`client_id`, `client_type_id`)
SELECT `e`.`entry_id`, `ct`.`client_type_id`
FROM `ledger`.`entries` `e`, `ledger`.`models` `m`, `ledger`.`client_types` `ct`
WHERE `m`.`model_class_name` = 'Core\\Model\\Client' AND `m`.`model_id` = `e`.`model_id`
AND `ct`.`client_type_name` = 'Company';

INSERT INTO `ledger`.`companies` (`company_id`, `company_code`,`company_name`,`company_short_name`)
SELECT `c`.`client_id`, '0001','Home Company','Home'
FROM `ledger`.`clients` `c`, `ledger`.`client_types` `ct`
WHERE `c`.`client_type_id` = `ct`.`client_type_id` AND `ct`.`client_type_name` = 'Company';

-- INSERT INTO `ledger`.`file_maps` (`file_map_name`) VALUES ('Standard File Map');

-- INSERT INTO `ledger`.`entry_types` (`entry_type_name`) VALUES ('Company');
-- INSERT INTO `ledger`.`entries` (`entry_type_id`) VALUES (8);
-- INSERT INTO `ledger`.`clients` (`client_id`, `client_name`,`short_name`) VALUES (8, 'First Company', 'FCo');
-- INSERT INTO `ledger`.`companies` (`company_id`, `company_code`) VALUES (8,'0001');
-- ---------------------
-- Setup Rights for Root
-- ---------------------
-- INSERT INTO `ledger`.`user_groups` VALUES (2,3);
-- INSERT INTO `ledger`.`entry_type_groups` (`entry_type_id`,`group_id`,`level`)
-- SELECT `id`, 3, 1 FROM `entry_types`;
-- DELETE FROM `ledger`.`entry_type_groups` WHERE `entry_type_id` != 0;
-- ---------------------
-- Setup File Types
-- ---------------------
-- INSERT INTO `ledger`.`file_types` (`file_type_name`, `file_name_pattern`) VALUES
-- ('Card Issue Files', '(?i)^O'),
-- ('Accuiring Files', '(?i)^A'),
-- ('Card Charge Files', '(?i)^V');
-- SELECT * FROM `ledger`.`file_types`;
-- DELETE FROM `ledger`.`file_types` WHERE `file_type_id` != 0;
-- --------------
-- INSERT INTO `ledger`.`entries` (`entry_type`) VALUES (1);
-- INSERT INTO `ledger`.`folders` VALUES (1, 'first');
-- INSERT INTO `ledger`.`folder_entries` VALUES (1,1);
