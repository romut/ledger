CREATE TABLE `ledger`.`military` (
  `military_id` INT NOT NULL PRIMARY KEY,
  `military_state` TINYINT,
  `military_number` VARCHAR(128),
  
  CONSTRAINT `military_fk0`
    FOREIGN KEY (`military_id`)
    REFERENCES `ledger`.`persons` (`person_id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION
);
