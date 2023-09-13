CREATE TABLE sys_file_metadata (
  tracks int(11) DEFAULT '0' NOT NULL,
);

CREATE TABLE sys_file_reference (
	track_language varchar(30)  DEFAULT '' NOT NULL,
	track_type     varchar(30)  DEFAULT '' NOT NULL,
	track_label    varchar(255) DEFAULT '' NOT NULL,
	track_default  tinyint(4) DEFAULT '0' NOT NULL,
);
