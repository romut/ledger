DROP TABLE `ledger`.`registry_entries`;
DROP TABLE `ledger`.`registries`;
DROP TABLE `ledger`.`military`;
DROP TABLE `ledger`.`person_passports`;
DROP TABLE `ledger`.`persons`;
DROP TABLE `ledger`.`companies`;
DROP TABLE `ledger`.`file_errors`;
DROP TABLE `ledger`.`file_cell_values`;
DROP TABLE `ledger`.`file_cells`;
DROP TABLE `ledger`.`files`;
DROP TABLE `ledger`.`client_accounts`;
DROP TABLE `ledger`.`client_file_maps`;
DROP TABLE `ledger`.`clients`;
DROP TABLE `ledger`.`client_types`;
DROP TABLE `ledger`.`file_map_entries`;
DROP TABLE `ledger`.`file_maps`;
DROP TABLE `ledger`.`file_type_cells`;
DROP TABLE `ledger`.`file_types`;
DROP TABLE `ledger`.`cell_types`;
DROP TABLE `ledger`.`book_chapters`;
DROP TABLE `ledger`.`books`;
DROP TABLE `ledger`.`log_lines`;
DROP TABLE `ledger`.`logs`;
DROP TABLE `ledger`.`entry_users`;
DROP TABLE `ledger`.`entry_groups`;
DROP TABLE `ledger`.`user_groups`;
DROP TABLE `ledger`.`groups`;
DROP TABLE `ledger`.`users`;
DROP TABLE `ledger`.`folder_entries`;
DROP TABLE `ledger`.`folders`;
DROP TABLE `ledger`.`entries`;
DROP TABLE `ledger`.`model_fields`;
DROP TABLE `ledger`.`models`;
DROP TABLE `ledger`.`field_types`;

CREATE TABLE `ledger`.`field_types` (
  `field_type_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `field_type` VARCHAR(32),
  `class` VARCHAR(64) NULL,
  `size` INT,
  `precision` TINYINT,
  `template` VARCHAR(256),
  `field_type_description` VARCHAR(256) NOT NULL
);

CREATE TABLE `ledger`.`models` (
  `model_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `model_class_name` VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE `ledger`.`model_fields` (
  `model_id` INT NOT NULL,
  `field_no` INT NOT NULL,
  `field_type_id` INT NOT NULL,
  `field_name` VARCHAR(126) NOT NULL,
  
  PRIMARY KEY (`model_id`, `field_no`),
  INDEX `model_fields_ix0` (`model_id` ASC),
  INDEX `model_fields_ix1` (`field_type_id` ASC),

  CONSTRAINT `model_fields_fk0`
    FOREIGN KEY (`model_id`)
    REFERENCES `ledger`.`models` (`model_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `model_fields_fk1`
    FOREIGN KEY (`field_type_id`)
    REFERENCES `ledger`.`field_types` (`field_type_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
);

CREATE TABLE `ledger`.`entries` (
  `entry_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `model_id` INT NOT NULL,
  `parent_id` INT NULL,
  `entry_state` TINYINT DEFAULT 0,
  
  INDEX `entries_ix0` (`model_id` ASC),
  INDEX `entries_ix1` (`parent_id` ASC),

  CONSTRAINT `entries_fk0`
    FOREIGN KEY (`model_id`)
    REFERENCES `ledger`.`models` (`model_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `entries_fk1`
    FOREIGN KEY (`parent_id`)
    REFERENCES `ledger`.`entries` (`entry_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
);

CREATE TABLE `ledger`.`folders` (
  `folder_id` INT NOT NULL PRIMARY KEY,
  `folder_name` VARCHAR(64) NOT NULL,
  `folder_description` VARCHAR(256) NULL,

  CONSTRAINT `folders_fk0`
    FOREIGN KEY (`folder_id`)
    REFERENCES `ledger`.`entries` (`entry_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
);

CREATE TABLE `ledger`.`folder_entries` (
  `folder_id` INT NOT NULL,
  `entry_id` INT NOT NULL,
  
  PRIMARY KEY (`folder_id`, `entry_id`),
  
  INDEX `folder_entries_ix0` (`folder_id` ASC),
  INDEX `folder_entries_ix1` (`entry_id` ASC),
  
  CONSTRAINT `folder_entries_fk0`
    FOREIGN KEY (`folder_id`)
    REFERENCES `ledger`.`folders` (`folder_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `folder_entries_fk1`
    FOREIGN KEY (`entry_id`)
    REFERENCES `ledger`.`entries` (`entry_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION  
);

CREATE TABLE `ledger`.`users` (
  `user_id` INT NOT NULL PRIMARY KEY,
  `login` VARCHAR(50) UNIQUE NOT NULL,
  `password` VARCHAR(32) NULL,
  `user_name` VARCHAR(256) NULL,
  
  CONSTRAINT `users_fk0`
    FOREIGN KEY (`user_id`)
    REFERENCES `ledger`.`entries` (`entry_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION  
);

CREATE TABLE `ledger`.`groups` (
  `group_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `group_name` VARCHAR(64) NOT NULL,
  `group_description` VARCHAR(256) NULL,

  CONSTRAINT `groups_fk0`
    FOREIGN KEY (`group_id`)
    REFERENCES `ledger`.`entries` (`entry_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION  
);

CREATE TABLE `ledger`.`user_groups` (
  `user_id` INT NOT NULL,
  `group_id` INT NOT NULL,
  
  PRIMARY KEY (`user_id`, `group_id`),
  INDEX `user_groups_ix0` (`user_id` ASC),
  INDEX `user_groups_ix1` (`group_id` ASC),
  CONSTRAINT `user_groups_fk0`
    FOREIGN KEY (`user_id`)
    REFERENCES `ledger`.`users` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `user_groups_fk1`
    FOREIGN KEY (`group_id`)
    REFERENCES `ledger`.`groups` (`group_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION  
);

CREATE TABLE `ledger`.`entry_groups` (
  `entry_id` INT NOT NULL,
  `right_level` INT NOT NULL,
  `group_id` INT NOT NULL,
  
  PRIMARY KEY (`entry_id`, `right_level`, `group_id`),
  
  INDEX `entry_groups_ix0` (`entry_id` ASC),
  INDEX `entry_groups_ix1` (`group_id` ASC),
  
  CONSTRAINT `entry_groups_fk0`
    FOREIGN KEY (`entry_id`)
    REFERENCES `ledger`.`entries` (`entry_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,  
  CONSTRAINT `entry_groups_fk1`
    FOREIGN KEY (`group_id`)
    REFERENCES `ledger`.`groups` (`group_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION  
);

CREATE TABLE `ledger`.`entry_users` (
  `entry_id` INT NOT NULL,
  `right_level` INT NOT NULL,
  `user_id` INT NOT NULL,
  `action_date` DATETIME NOT NULL,
  
  PRIMARY KEY (`entry_id`, `right_level`, `user_id`),
  
  INDEX `entry_users_ix0` (`entry_id` ASC),
  INDEX `entry_users_ix1` (`user_id` ASC),
  
  CONSTRAINT `entry_users_fk0`
    FOREIGN KEY (`entry_id`)
    REFERENCES `ledger`.`entries` (`entry_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,  
  CONSTRAINT `entry_users_fk1`
    FOREIGN KEY (`user_id`)
    REFERENCES `ledger`.`users` (`user_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION  
);

CREATE TABLE `ledger`.`logs` (
  `log_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `entry_id` INT NULL,
  `user_id` INT NOT NULL,
  `log_time` DATETIME NOT NULL,
  `log_action` INT NOT NULL,
  `line_ext` TINYINT NOT NULL DEFAULT 0,
  `log_description` VARCHAR(256),
  
  INDEX `logs_ix0` (`user_id`),
  INDEX `logs_ix1` (`entry_id`)
);

CREATE TABLE `ledger`.`log_lines` (
  `log_id` INT NOT NULL,
  `line_no` INT NOT NULL,
  `description` VARCHAR(256),
  
  PRIMARY KEY (`log_id`, `line_no`),
  INDEX `log_lines_ix0` (`log_id`),

  CONSTRAINT `log_lines_fk0`
    FOREIGN KEY (`log_id`)
    REFERENCES `ledger`.`logs` (`log_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
);

CREATE TABLE `ledger`.`books` (
  `book_id` INT NOT NULL PRIMARY KEY,
  `book_name` VARCHAR(255),
  `data_path` VARCHAR(256),

  INDEX `books_ix0` (`book_name`),
  
  CONSTRAINT `books_fk0`
    FOREIGN KEY (`book_id`)
    REFERENCES `ledger`.`entries` (`entry_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
);

CREATE TABLE `ledger`.`book_chapters` (
  `book_chapter_id` INT NOT NULL PRIMARY KEY,
  `class` VARCHAR(255),
  `book_chapter_name` VARCHAR(255),
  
  INDEX `book_chapters_ix0` (`book_chapter_name`),

  CONSTRAINT `book_chapters_fk0`
    FOREIGN KEY (`book_chapter_id`)
    REFERENCES `ledger`.`entries` (`entry_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
);

CREATE TABLE `ledger`.`cell_types` (
  `cell_type_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cell_type_name` VARCHAR(256) NOT NULL,
  `cell_type` VARCHAR(64),
  `cell_type_class` VARCHAR(64) NULL,
  `size` INT,
  `precision` TINYINT
);

CREATE TABLE `ledger`.`file_types` (
  `file_type_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `book_chapter_id` INT NOT NULL,
  `file_type_name` VARCHAR(256) NOT NULL,
  `file_name_pattern` VARCHAR(256),
  
  INDEX `file_types_ix1` (`book_chapter_id`),

  CONSTRAINT `file_types_fk0`
    FOREIGN KEY (`book_chapter_id`)
    REFERENCES `ledger`.`book_chapters` (`book_chapter_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
);

CREATE TABLE `ledger`.`file_type_cells` (
  `file_type_id` INT NOT NULL,
  `cell_no` INT NOT NULL,
  `cell_type_id` INT NOT NULL,

  PRIMARY KEY (`file_type_id`, `cell_no`),
  INDEX `file_type_cells_ix0` (`file_type_id`),
  INDEX `file_type_cells_ix1` (`cell_type_id`),

  CONSTRAINT `file_type_cells_fk0`
    FOREIGN KEY (`file_type_id`)
    REFERENCES `ledger`.`file_types` (`file_type_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `file_type_cells_fk1`
    FOREIGN KEY (`cell_type_id`)
    REFERENCES `ledger`.`cell_types` (`cell_type_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
);

CREATE TABLE `ledger`.`file_maps` (
  `file_map_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `file_map_name` VARCHAR(256) NOT NULL
);

CREATE TABLE `ledger`.`file_map_entries` (
  `file_map_id` INT NOT NULL,
  `cell_input_no` INT NOT NULL,
  `cell_output_no` INT NOT NULL,
 
  PRIMARY KEY (`file_map_id`, `cell_input_no`),
  INDEX `file_map_entries_ix0` (`file_map_id`),

  CONSTRAINT `file_map_entries_fk0`
    FOREIGN KEY (`file_map_id`)
    REFERENCES `ledger`.`file_maps` (`file_map_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
);

CREATE TABLE `ledger`.`client_types` (
  `client_type_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `client_type_name` VARCHAR(255) NOT NULL UNIQUE
);


CREATE TABLE `ledger`.`clients` (
  `client_id` INT NOT NULL PRIMARY KEY,
  `client_type_id` INT NOT NULL,
  
  CONSTRAINT `clients_fk0`
    FOREIGN KEY (`client_id`)
    REFERENCES `ledger`.`entries` (`entry_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `clients_fk1`
    FOREIGN KEY (`client_type_id`)
    REFERENCES `ledger`.`client_types` (`client_type_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION  

);

CREATE TABLE `ledger`.`client_file_maps` (
  `client_id` INT NOT NULL,
  `file_type_id` INT NOT NULL,
  `file_map_id` INT NOT NULL,
  
  PRIMARY KEY (`client_id`, `file_type_id`),
  INDEX `client_file_maps_ix0` (`client_id` ASC),
  INDEX `client_file_maps_ix1` (`file_type_id` ASC),
  INDEX `client_file_maps_ix2` (`file_map_id` ASC),

  CONSTRAINT `client_file_maps_fk0`
    FOREIGN KEY (`client_id`)
    REFERENCES `ledger`.`clients` (`client_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `client_file_maps_fk1`
    FOREIGN KEY (`file_type_id`)
    REFERENCES `ledger`.`file_types` (`file_type_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `client_file_maps_fk2`
    FOREIGN KEY (`file_map_id`)
    REFERENCES `ledger`.`file_maps` (`file_map_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION  
);

CREATE TABLE `ledger`.`client_accounts` (
  `client_id` INT NOT NULL,
  `client_account` VARCHAR(20) NOT NULL,
  `client_account_state` TINYINT NOT NULL,
  
  PRIMARY KEY (`client_id`, `client_account`),
  INDEX `client_accounts_ix0` (`client_id` ASC),
  INDEX `client_accounts_ix1` (`client_account` ASC),

  CONSTRAINT `client_accounts_fk0`
    FOREIGN KEY (`client_id`)
    REFERENCES `ledger`.`clients` (`client_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
);

CREATE TABLE `ledger`.`files` (
  `file_id` INT NOT NULL PRIMARY KEY,
  `book_chapter_id` INT NOT NULL,
  `file_type_id` INT NULL,
  `file_map_id` INT NULL,
  `client_id` INT NULL,
  `file_state` TINYINT NOT NULL DEFAULT 0,
  `file_name` VARCHAR(256) NOT NULL,
  `file_size` INT NULL,
  `file_create_date` DATETIME NULL,
  `file_modify_date` DATETIME NULL,
  `file_load_date` DATETIME NULL,
  `max_row` INT NULL,
  `error_count` INT NULL,

  INDEX `files_ix0` (`book_chapter_id` ASC),
  INDEX `files_ix1` (`file_type_id` ASC),
  INDEX `files_ix2` (`client_id` ASC),
  INDEX `files_ix3` (`file_map_id` ASC),

  CONSTRAINT `files_fk0`
    FOREIGN KEY (`file_id`)
    REFERENCES `ledger`.`entries` (`entry_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `files_fk1`
    FOREIGN KEY (`book_chapter_id`)
    REFERENCES `ledger`.`book_chapters` (`book_chapter_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `files_fk2`
    FOREIGN KEY (`file_type_id`)
    REFERENCES `ledger`.`file_types` (`file_type_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `files_fk3`
    FOREIGN KEY (`client_id`)
    REFERENCES `ledger`.`clients` (`client_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `files_fk4`
    FOREIGN KEY (`file_map_id`)
    REFERENCES `ledger`.`file_maps` (`file_map_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
);

CREATE TABLE `ledger`.`file_cells` (
  `file_id` INT NOT NULL,
  
  `row` INT NOT NULL,
  `column` INT NOT NULL,
  `value_ext` TINYINT NOT NULL DEFAULT 0,
  `value` VARCHAR(256),
  
  PRIMARY KEY (`file_id`, `row`, `column`),
  INDEX `file_cells_ix0` (`file_id`, `row` ASC),

  CONSTRAINT `file_cells_fk0`
    FOREIGN KEY (`file_id`)
    REFERENCES `ledger`.`files` (`file_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
);

CREATE TABLE `ledger`.`file_cell_values` (
  `file_id` INT NOT NULL,
  `row` INT NOT NULL,
  `column` INT NOT NULL,
  `line_no` INT NOT NULL,
  
  `value` VARCHAR(256),
  
  PRIMARY KEY (`file_id`, `row`, `column`, `line_no`),
  INDEX `file_cell_values_ix0` (`file_id`, `row`, `column` ASC),

  CONSTRAINT `file_cell_values_fk0`
    FOREIGN KEY (`file_id`, `row`, `column`)
    REFERENCES `ledger`.`file_cells` (`file_id`, `row`, `column`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
);

CREATE TABLE `ledger`.`file_errors` (
  `file_error_id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `file_id` INT NOT NULL,
  
  `file_row` INT NULL,
  `file_column` INT NULL,
  `error_no` INT NULL,
  `error_description` VARCHAR(256) NULL,
  
  INDEX `file_cell_errors_ix0` (`file_id` ASC),
  INDEX `file_cell_errors_ix1` (`file_id`, `file_row` ASC),

  CONSTRAINT `file_cell_errors_fk0`
    FOREIGN KEY (`file_id`)
    REFERENCES `ledger`.`files` (`file_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
);

CREATE TABLE `ledger`.`companies` (
  `company_id` INT NOT NULL PRIMARY KEY,
  `company_code` VARCHAR(12) NOT NULL UNIQUE,
  `company_short_name` VARCHAR(64) NOT NULL,
  `company_name` VARCHAR(256) NOT NULL,

  CONSTRAINT `companies_fk0`
    FOREIGN KEY (`company_id`)
    REFERENCES `ledger`.`clients` (`client_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION  
);

CREATE TABLE `ledger`.`persons` (
  `person_id` INT NOT NULL PRIMARY KEY,
  `last_name` VARCHAR(50) NOT NULL,
  `first_name` VARCHAR(50) DEFAULT NULL,
  `patronymic` VARCHAR(50) DEFAULT NULL,
  `sex` CHAR(1) NULL,
  `birthday` DATE NULL,
  `birthplace` VARCHAR(150) DEFAULT NULL,

  CONSTRAINT `persons_fk0`
    FOREIGN KEY (`person_id`)
    REFERENCES `ledger`.`clients` (`client_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION  
);

CREATE TABLE `ledger`.`person_passports` (
  `person_id` INT NOT NULL,
  `passport_state` TINYINT,

  `passport_type` VARCHAR(5) DEFAULT NULL,
  `passport_series` VARCHAR(10) DEFAULT NULL,
  `passport_id` VARCHAR(25) DEFAULT NULL,
  `passport_date` DATE DEFAULT NULL,
  `passport_place` VARCHAR(256) DEFAULT NULL,

  PRIMARY KEY (`passport_type`, `passport_series`, `passport_id`),
  INDEX `person_passports_ix0` (`person_id` ASC),

  CONSTRAINT `person_passports_fk0`
    FOREIGN KEY (`person_id`)
    REFERENCES `ledger`.`persons` (`person_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION  
);

CREATE TABLE `ledger`.`registries` (
  `registry_id` INT NOT NULL PRIMARY KEY,
  `registry_state` TINYINT NOT NULL,
  `registry_entry_count` INT NOT NULL DEFAULT 0,
  `file_id` INT NULL,

  INDEX `registries_ix0` (`file_id` ASC),

  CONSTRAINT `registries_fk0`
    FOREIGN KEY (`registry_id`)
    REFERENCES `ledger`.`entries` (`entry_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `registries_fk1`
    FOREIGN KEY (`file_id`)
    REFERENCES `ledger`.`files` (`file_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION    
);

CREATE TABLE `ledger`.`registry_entries` (
  `registry_id` INT NOT NULL,
  `registry_entry_no` INT NOT NULL,
  `entry_id` INT NOT NULL,
  `entry_state` INT NOT NULL DEFAULT 0,
  
  PRIMARY KEY (`registry_id`, `registry_entry_no`),
  
  INDEX `registry_entries_ix0` (`registry_id` ASC),
  INDEX `registry_entries_ix1` (`entry_id` ASC),
  
  CONSTRAINT `registry_entries_fk0`
    FOREIGN KEY (`registry_id`)
    REFERENCES `ledger`.`registries` (`registry_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `registry_entries_fk1`
    FOREIGN KEY (`entry_id`)
    REFERENCES `ledger`.`entries` (`entry_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION  
);
