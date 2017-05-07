ALTER TABLE `users` ADD UNIQUE(`login`);
ALTER TABLE `users` CHANGE `password` `password` VARCHAR(70) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;