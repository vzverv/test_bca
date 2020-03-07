CREATE TABLE "client"
(
	id INTEGER
		constraint client_pk
			primary key autoincrement,
	salutation TEXT,
	first_name TEXT,
	last_name TEXT,
	email TEXT,
	country TEXT,
	zip_code TEXT,
	asset_class TEXT,
	investment_time TEXT,
	expected_purchase_date TEXT,
	status INTEGER,
	comments TEXT
)