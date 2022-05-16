#IfNotTable tele_request
CREATE TABLE `tele_request` (
`id` bigint(20) NOT NULL AUTO_INCREMENT,
`pid` bigint NOT NULL,
`date` date DEFAULT NULL,
`request_provider_id` int(11) NULL,
`attend_provider_id` int(11) NULL,
`status` varchar(255) NOT NULL DEFAULT 'Waiting',
`reason` text,
`created_at` datetime DEFAULT CURRENT_TIMESTAMP,
`updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`)
) ENGINE=InnoDB;
#EndIf

#IfMissingColumn users status
ALTER TABLE `users` ADD COLUMN `status` tinyint DEFAULT 0;
#EndIf

#IfMissingColumn tele_request patient_uri
ALTER TABLE `tele_request` ADD COLUMN `patient_uri` text DEFAULT NULL;
#EndIf

#IfMissingColumn tele_request provider_uri
ALTER TABLE `tele_request` ADD COLUMN `provider_uri` text DEFAULT NULL;
#EndIf

#IfMissingColumn tele_request room
ALTER TABLE `tele_request` ADD COLUMN `room` varchar(255) DEFAULT NULL;
#EndIf

#IfMissingColumn tele_request request_type
ALTER TABLE `tele_request` ADD COLUMN `request_type` varchar(255) DEFAULT NULL;
#EndIf

#IfMissingColumn tele_request userids
ALTER TABLE `tele_request` ADD COLUMN `userids` varchar(255) DEFAULT NULL;
#EndIf


#IfNotTable twilio_rooms
CREATE TABLE `twilio_rooms` (
`id` bigint(20) NOT NULL AUTO_INCREMENT,
`room` varchar(255) NULL,
`provider_id` int(11) NULL,
`tele_request_id` int(11) NULL,
`status` tinyint(4) NOT NULL DEFAULT 0,
`url` text,
`created_at` datetime DEFAULT CURRENT_TIMESTAMP,
`updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`)
) ENGINE=InnoDB;
#EndIf

-- Clearing House
#IfNotTable claims_status277
CREATE TABLE `claims_status277` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `claimid` varchar(250) DEFAULT NULL,
  `claim_status_category_code` text DEFAULT NULL,
  `claim_status_code` text DEFAULT NULL,
  `entity_identifier_code` text DEFAULT NULL,
  `date_received` date DEFAULT NULL,
  `version` text DEFAULT NULL,
  `date_update` date DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `encounter` int(11) DEFAULT NULL,
  `statusReasonCode` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
#EndIf