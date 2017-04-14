ALTER TABLE `bets` ADD `nb_img` INT(1) NOT NULL AFTER ;
ALTER TABLE `bets` CHANGE `accomplished` `accomplished` VARCHAR(11) NOT NULL DEFAULT '0';