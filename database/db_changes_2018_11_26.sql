CREATE TABLE `arm_levelconfig` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `increase_per_trans` INT NOT NULL DEFAULT 1 COMMENT 'limit for increase level',
  PRIMARY KEY (`id`));
INSERT INTO `arm_levelconfig` (`id`, `increase_per_trans`) VALUES ('1', '2');
ALTER TABLE `arm_levelconfig` 
ADD COLUMN `increase_per_refer` INT NOT NULL DEFAULT 1 AFTER `increase_per_trans`,
ADD COLUMN `level` INT NOT NULL DEFAULT 1 AFTER `increase_per_refer`;
ALTER TABLE `arm_members` 
ADD COLUMN `transCountFromLastLevel` INT NOT NULL DEFAULT 0 AFTER `isDelete`,
ADD COLUMN `referCountFromLastLevel` INT NOT NULL DEFAULT 0 AFTER `transCountFromLastLevel`;