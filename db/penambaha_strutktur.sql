catatan penambahan db

ALTER TABLE `mahasiswa` ADD `jmlh_kitas` INT NOT NULL AFTER `ijazah`;
ALTER TABLE `mahasiswa` ADD `pt_asal` TEXT NOT NULL AFTER `jmlh_kitas`;
ALTER TABLE `mahasiswa` ADD `dok_mou` VARCHAR(255) NOT NULL AFTER `pt_asal`;
ALTER TABLE `mahasiswa` CHANGE `jmlh_kitas` `jmlh_kitas` INT(11) NULL, CHANGE `pt_asal` `pt_asal` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL, CHANGE `dok_mou` `dok_mou` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL;
ALTER TABLE `mahasiswa` CHANGE `jmlh_kitas` `jml_kitas` INT(11) NULL DEFAULT NULL;
