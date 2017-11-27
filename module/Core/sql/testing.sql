-- -------------
-- Check tables
-- -------------
SELECT * FROM `ledger`.`field_types`;
SELECT * FROM `ledger`.`models`;
SELECT * FROM `ledger`.`model_fields`;
SELECT * FROM `ledger`.`entry_types`;
SELECT * FROM `ledger`.`folders`;
SELECT * FROM `ledger`.`users`;
SELECT * FROM `ledger`.`groups`;
SELECT * FROM `ledger`.`entries`;
SELECT * FROM `ledger`.`user_groups`;
SELECT * FROM `ledger`.`entry_type_groups`;
SELECT * FROM `ledger`.`books`;
SELECT * FROM `ledger`.`book_chapters`;
SELECT * FROM `ledger`.`file_types`;
SELECT * FROM `ledger`.`files`;
SELECT * FROM `ledger`.`file_cells`;
SELECT * FROM `ledger`.`file_errors`;
SELECT * FROM `ledger`.`client_types`;
SELECT * FROM `ledger`.`clients`;
SELECT * FROM `ledger`.`client_accounts`;
SELECT * FROM `ledger`.`companies`;
SELECT * FROM `ledger`.`persons`;
SELECT * FROM `ledger`.`person_passports`;
SELECT * FROM `ledger`.`military`;

SELECT * FROM `ledger`.`files` WHERE `file_id` = 116;
SELECT * FROM `ledger`.`file_cells` WHERE `file_id` = 26;

DELETE FROM `ledger`.`files` WHERE `file_id` = 9;
DELETE FROM `ledger`.`file_cells` WHERE `file_id` != 0;

SELECT * FROM `ledger`.`entries`, `ledger`.`folders`
WHERE `folders`.`entry_id` = `entries`.`id`;

SELECT * FROM `ledger`.`folder_entries`;

UPDATE `ledger`.`input_files` SET `row_count` = 9 WHERE `input_file_id` = 8;

SELECT * FROM `ledger`.`entries`;