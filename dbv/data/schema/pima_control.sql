CREATE TABLE `pima_control` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device_test_id` int(11) NOT NULL COMMENT 'Generated by the pima device',
  `pima_upload_id` int(11) NOT NULL COMMENT 'FK to pima Upload',
  `assay_id` int(11) NOT NULL,
  `sample_code` varchar(100) NOT NULL,
  `error_id` int(11) NOT NULL,
  `operator` varchar(100) NOT NULL,
  `barcode` int(11) NOT NULL,
  `expiry_date` int(11) NOT NULL,
  `device` int(11) NOT NULL,
  `software_version` varchar(50) NOT NULL,
  `cd4_count` int(11) NOT NULL,
  `facility_device_id` int(11) NOT NULL COMMENT 'fk to facility_equipment',
  `result_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Pima Test uploads'