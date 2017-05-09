

CREATE TABLE sws.company ( 
	id                   bigint UNSIGNED NOT NULL  AUTO_INCREMENT,
	trading_item_id      bigint UNSIGNED NOT NULL  ,
	name                 varchar(100)  NOT NULL  ,
	slug                 varchar(100)  NOT NULL  ,
	exchange_symbol      varchar(100)  NOT NULL  ,
	ticker_symbol        varchar(100)  NOT NULL  ,
	unique_symbol        varchar(100)  NOT NULL  ,
	primary_ticker       bit   DEFAULT 0 ,
	last_updated         timestamp    ,
	CONSTRAINT pk_company PRIMARY KEY ( id )
 ) engine=InnoDB;

CREATE TABLE sws.company_score ( 
	id                   bigint UNSIGNED NOT NULL  AUTO_INCREMENT,
	company_id           bigint UNSIGNED   ,
	value                int    ,
	income               int UNSIGNED   ,
	health               int    ,
	past                 int    ,
	future               int    ,
	total                int    ,
	CONSTRAINT pk_company_score PRIMARY KEY ( id )
 ) engine=InnoDB;

CREATE INDEX idx_company_score ON sws.company_score ( company_id );

CREATE TABLE sws.industry ( 
	id                   bigint UNSIGNED NOT NULL  AUTO_INCREMENT,
	name                 varchar(100)    ,
	CONSTRAINT pk_industry PRIMARY KEY ( id )
 ) engine=InnoDB;

CREATE TABLE sws.person ( 
	id                   bigint UNSIGNED NOT NULL  AUTO_INCREMENT,
	company_id           bigint UNSIGNED   ,
	is_ceo               bit    ,
	is_boardmember       bit    ,
	name                 varchar(100)    ,
	title                text    ,
	compensation         bigint UNSIGNED   ,
	compensationfriendly varchar(50)    ,
	age                  int    ,
	biography            longtext    ,
	CONSTRAINT pk_person PRIMARY KEY ( id )
 ) engine=InnoDB;

CREATE INDEX idx_person ON sws.person ( company_id );

CREATE TABLE sws.`user` ( 
	id                   bigint UNSIGNED NOT NULL  AUTO_INCREMENT,
	name                 varchar(100)  NOT NULL  ,
	email                varchar(255)  NOT NULL  ,
	given_name           varchar(100)  NOT NULL  ,
	family_name          varchar(100)  NOT NULL  ,
	picture              text    ,
	locale               varchar(100)   DEFAULT 'en' ,
	register_date        timestamp   DEFAULT CURRENT_TIMESTAMP ,
	country_iso          varchar(10)    ,
	token                varchar(100)    ,
	CONSTRAINT pk_user PRIMARY KEY ( id )
 ) engine=InnoDB;

CREATE TABLE sws.blacklist ( 
	id                   int  NOT NULL  AUTO_INCREMENT,
	user_id              bigint UNSIGNED   ,
	unique_symbol        varchar(100)  NOT NULL  ,
	trading_item_id      bigint UNSIGNED   ,
	CONSTRAINT pk_blacklist PRIMARY KEY ( id )
 ) engine=InnoDB;

CREATE INDEX idx_blacklist ON sws.blacklist ( user_id );

CREATE TABLE sws.company_industry ( 
	id                   bigint UNSIGNED NOT NULL  AUTO_INCREMENT,
	company_id           bigint UNSIGNED   ,
	primary_id           bigint UNSIGNED   ,
	secondary_id         bigint UNSIGNED   ,
	tertiary_id          bigint    ,
	CONSTRAINT pk_company_industry PRIMARY KEY ( id )
 ) engine=InnoDB;

CREATE INDEX idx_company_industry ON sws.company_industry ( company_id );

CREATE INDEX idx_company_industry_0 ON sws.company_industry ( primary_id );

CREATE INDEX idx_company_industry_1 ON sws.company_industry ( secondary_id );

CREATE INDEX idx_company_industry_2 ON sws.company_industry ( tertiary_id );

CREATE TABLE sws.company_info ( 
	id                   bigint UNSIGNED NOT NULL  AUTO_INCREMENT,
	company_id           bigint UNSIGNED   ,
	description          text    ,
	warning_type         int    ,
	company_industry_id  bigint UNSIGNED   ,
	fund                 bit   DEFAULT 0 ,
	status               varchar(100)    ,
	currency             varchar(10)    ,
	country              varchar(10)    ,
	employees            int UNSIGNED   ,
	address              text    ,
	year_founded         int    ,
	url                  text    ,
	logo_url             text    ,
	cover_url            text    ,
	cover_small_url      text    ,
	ceo_person_id        bigint UNSIGNED   ,
	legal_name           text    ,
	CONSTRAINT pk_company_info PRIMARY KEY ( id )
 ) engine=InnoDB;

CREATE INDEX idx_company_info ON sws.company_info ( company_id );

CREATE INDEX idx_company_info_0 ON sws.company_info ( ceo_person_id );

CREATE INDEX idx_company_info_1 ON sws.company_info ( company_industry_id );

CREATE TABLE sws.grid ( 
	id                   bigint UNSIGNED NOT NULL  AUTO_INCREMENT,
	user_id              bigint UNSIGNED   ,
	name                 varchar(100)    ,
	rulejson             json    ,
	sharing              bit   DEFAULT 0 ,
	description          text    ,
	CONSTRAINT pk_grid PRIMARY KEY ( id )
 ) engine=InnoDB;

CREATE INDEX idx_grid ON sws.grid ( user_id );

CREATE TABLE sws.grid_subscription ( 
	id                   bigint UNSIGNED NOT NULL  AUTO_INCREMENT,
	grid_id              bigint UNSIGNED   ,
	user_id              bigint UNSIGNED   ,
	CONSTRAINT pk_grid_subscription PRIMARY KEY ( id )
 ) engine=InnoDB;

CREATE INDEX idx_grid_subscription ON sws.grid_subscription ( grid_id );

CREATE INDEX idx_grid_subscription_0 ON sws.grid_subscription ( user_id );

CREATE TABLE sws.item_transactions ( 
	id                   bigint UNSIGNED NOT NULL  AUTO_INCREMENT,
	user_id              bigint UNSIGNED   ,
	item_id              bigint UNSIGNED   ,
	transaction_type     varchar(10)    ,
	amount               bigint UNSIGNED   ,
	purchase_date        timestamp    ,
	cost                 decimal(20,3) UNSIGNED   ,
	CONSTRAINT pk_item_transactions PRIMARY KEY ( id )
 ) engine=InnoDB;

CREATE INDEX idx_item_transactions ON sws.item_transactions ( item_id );

CREATE INDEX idx_item_transactions_0 ON sws.item_transactions ( user_id );

CREATE TABLE sws.portfolio ( 
	id                   bigint UNSIGNED NOT NULL  AUTO_INCREMENT,
	user_id              bigint UNSIGNED   ,
	name                 varchar(100)    ,
	currency_iso         varchar(10)    ,
	sharing              bit   DEFAULT 1 ,
	CONSTRAINT pk_portfolio PRIMARY KEY ( id )
 ) engine=InnoDB;

CREATE INDEX idx_portfolio ON sws.portfolio ( user_id );

CREATE TABLE sws.portfolio_items ( 
	id                   bigint UNSIGNED NOT NULL  AUTO_INCREMENT,
	portfolio_id         bigint UNSIGNED   ,
	item_id              bigint UNSIGNED   ,
	CONSTRAINT pk_portfolio_items PRIMARY KEY ( id )
 ) engine=InnoDB;

CREATE INDEX idx_portfolio_items ON sws.portfolio_items ( portfolio_id );

CREATE INDEX idx_portfolio_items_0 ON sws.portfolio_items ( item_id );

ALTER TABLE sws.blacklist ADD CONSTRAINT fk_blacklist FOREIGN KEY ( user_id ) REFERENCES sws.`user`( id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE sws.company_industry ADD CONSTRAINT fk_company_industry FOREIGN KEY ( company_id ) REFERENCES sws.company( id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE sws.company_industry ADD CONSTRAINT fk_company_industry_0 FOREIGN KEY ( primary_id ) REFERENCES sws.industry( id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sws.company_industry ADD CONSTRAINT fk_company_industry_1 FOREIGN KEY ( secondary_id ) REFERENCES sws.industry( id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE sws.company_industry ADD CONSTRAINT fk_company_industry_3 FOREIGN KEY ( tertiary_id ) REFERENCES sws.industry( id ) ON DELETE SET NULL ON UPDATE SET NULL;

ALTER TABLE sws.company_info ADD CONSTRAINT fk_company_info FOREIGN KEY ( company_id ) REFERENCES sws.company( id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE sws.company_info ADD CONSTRAINT fk_company_info_0 FOREIGN KEY ( ceo_person_id ) REFERENCES sws.person( id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE sws.company_info ADD CONSTRAINT fk_company_info_1 FOREIGN KEY ( company_industry_id ) REFERENCES sws.company_industry( id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE sws.company_score ADD CONSTRAINT fk_company_score FOREIGN KEY ( company_id ) REFERENCES sws.company( id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE sws.grid ADD CONSTRAINT fk_grid FOREIGN KEY ( user_id ) REFERENCES sws.`user`( id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE sws.grid_subscription ADD CONSTRAINT fk_grid_subscription FOREIGN KEY ( grid_id ) REFERENCES sws.grid( id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE sws.grid_subscription ADD CONSTRAINT fk_grid_subscription_0 FOREIGN KEY ( user_id ) REFERENCES sws.`user`( id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE sws.item_transactions ADD CONSTRAINT fk_item_transactions FOREIGN KEY ( item_id ) REFERENCES sws.company( id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE sws.item_transactions ADD CONSTRAINT fk_item_transactions_0 FOREIGN KEY ( user_id ) REFERENCES sws.`user`( id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE sws.person ADD CONSTRAINT fk_person FOREIGN KEY ( company_id ) REFERENCES sws.company( id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE sws.portfolio ADD CONSTRAINT fk_portfolio FOREIGN KEY ( user_id ) REFERENCES sws.`user`( id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE sws.portfolio_items ADD CONSTRAINT fk_portfolio_items FOREIGN KEY ( portfolio_id ) REFERENCES sws.portfolio( id ) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE sws.portfolio_items ADD CONSTRAINT fk_portfolio_items_0 FOREIGN KEY ( item_id ) REFERENCES sws.company( id ) ON DELETE CASCADE ON UPDATE CASCADE;

