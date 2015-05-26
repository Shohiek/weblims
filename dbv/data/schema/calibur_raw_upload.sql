CREATE TABLE `calibur_raw_upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `institution` varchar(30) DEFAULT NULL,
  `director` varchar(30) DEFAULT NULL,
  `operator` varchar(30) DEFAULT NULL,
  `cytometer` varchar(30) DEFAULT NULL,
  `cytometer_serial_number` varchar(20) DEFAULT NULL,
  `sw_version` varchar(40) DEFAULT NULL,
  `sample_name` varchar(30) DEFAULT NULL,
  `sample_id` varchar(20) DEFAULT NULL,
  `case_number` varchar(20) DEFAULT NULL,
  `age` float(6,2) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `facility_id` int(20) DEFAULT NULL,
  `panel_name` varchar(20) DEFAULT NULL,
  `date_analyzed` date DEFAULT NULL,
  `lab_report_file_name` varchar(30) DEFAULT NULL,
  `physicians_report_file_name` varchar(30) DEFAULT NULL,
  `ref_range` varchar(20) DEFAULT NULL,
  `comments` varchar(200) DEFAULT NULL,
  `CD3CD4CD45TruCFCS_fileN_name` varchar(40) DEFAULT NULL,
  `CD3CD4CD45TruC_lot_id` int(30) DEFAULT NULL,
  `CD3CD4CD45TruC_error_codes` int(10) DEFAULT NULL,
  `CD3CD4CD45TruCCD3_lymph` float(10,2) DEFAULT NULL,
  `CD3CD4CD45TruCCD3_abs_cnt` float(10,2) DEFAULT NULL,
  `CD3CD4CD45TruCCD3CD4_lymph` float(10,2) DEFAULT NULL,
  `CD3CD4CD45TruCCD3CD4_abs_cnt` float(10,2) DEFAULT NULL,
  `CD3CD4CD45TruCCD45_abs_cnt` float(10,2) DEFAULT NULL,
  `is_uploaded` int(2) DEFAULT '0',
  `upload_file_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sample_id` (`sample_id`,`case_number`,`facility_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1