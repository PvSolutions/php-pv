create table membership_session(
	token varchar(500),
	member_id varchar(255),
	device varchar(128),
	date_creation datetime,
	date_action datetime,
	remember tinyint(1) default '0',
	primary key(token)
) ;