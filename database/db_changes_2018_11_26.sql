CREATE TABLE `arm_levelconfig` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `increase_per_trans` INT NOT NULL DEFAULT 1 COMMENT 'limit for increase level',
  PRIMARY KEY (`id`));
INSERT INTO `arm_levelconfig` (`id`, `increase_per_trans`) VALUES ('1', '2');
