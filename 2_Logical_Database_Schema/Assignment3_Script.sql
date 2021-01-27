/*
edit1:
	--added line create database and use
    --added drop table if exists
    --changed keyword account and contains to ACCOUNTS and containss,
	--foreign key expects a colomn so added that as well,
	--changed on delete set null on register table to on
	--delete no action
    --on holds table there was a duplicate accoundid colomn on primary key so removed that as well
    --changed the order of accounts and permission table as it was below Holds table which gave an error
edit2:
	--changed containss to organizes
    --added unique constraint on mod which is on table supervises
    --added unique constraint to student on table HAS
    --changed foreign key to reference register table instead of student and club table
	--added account_des attribute in account
    --added contraint on table MANAGES such that one of two
    -added unique contsraint on studentid and clubid on table MANAGES
*/

CREATE DATABASE if not exists project_14;
USE project_14;

DROP TABLE IF EXISTS COACH,HASA,SPORTS,STUDENT,PERMISSION,CLUB,REGISTER,HAS,ACTIVITY,ORGANIZES,MODERATOR,SUPERVISES,HOLDS,ACCOUNTS,MANAGES;

CREATE TABLE STUDENT (
	studentid INT,
	student_name VARCHAR(255) NOT NULL,
	dateofbirth DATE NOT NULL,
	gender VARCHAR(10) NOT NULL,
	major VARCHAR(50) NOT NULL,
	phone VARCHAR(30),
	PRIMARY KEY (studentid)
);


CREATE TABLE CLUB (
	clubid INT,
	clubname VARCHAR(100) NOT NULL,
	clubdescription TEXT NOT NULL,
	contact VARCHAR(50) NOT NULL,
	ratings decimal(2,1),
	other_clubs TINYINT,
	arts TINYINT,
	dance TINYINT,
	outreach_and_fellowship TINYINT,
	PRIMARY KEY (clubid),
	CONSTRAINT check_ratings CHECK (ratings >=0 AND ratings<=5)
);

CREATE TABLE SPORTS (
	team_name VARCHAR(100) NOT NULL UNIQUE,
    clubid INT NOT NULL,
    PRIMARY KEY (team_name,clubid),
    FOREIGN KEY (clubid) REFERENCES CLUB(clubid)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE COACH (
	coach_name VARCHAR(50) NOT NULL,
    coach_id INT,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(30),
    PRIMARY KEY (coach_id)
);

CREATE TABLE HASA (
	coach_id INT NOT NULL,
    clubid INT NOT NULL UNIQUE,
    FOREIGN KEY (coach_id) REFERENCES COACH(coach_id)
		ON DELETE CASCADE
        ON UPDATE CASCADE,
	FOREIGN KEY (clubid) REFERENCES CLUB(clubid)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);


CREATE TABLE REGISTER (
	date_joined DATE,
	studentid INT NOT NULL,
	clubid INT,
	PRIMARY KEY (studentid,clubid),
	FOREIGN KEY (studentid) REFERENCES STUDENT(studentid)
		ON DELETE NO ACTION
		ON UPDATE CASCADE,
	FOREIGN KEY (clubid) REFERENCES CLUB(clubid)
		ON DELETE NO ACTION
		ON UPDATE CASCADE
);

CREATE TABLE HAS (
	memberid INT AUTO_INCREMENT,
	studentid INT NOT NULL UNIQUE,
	clubid INT NOT NULL,
	PRIMARY KEY (memberid),
	FOREIGN KEY (studentid,clubid) REFERENCES REGISTER(studentid,clubid)
		ON DELETE CASCADE
        ON UPDATE CASCADE
);


CREATE TRIGGER logonregister
	AFTER INSERT ON REGISTER
	FOR EACH ROW
		INSERT INTO HAS(studentid, clubid)
		SELECT studentid, clubid
		FROM NEW;


CREATE TABLE ACTIVITY (
	activityid INT,
	activity_name VARCHAR(50) NOT NULL,
	location VARCHAR(50),
	activity_desc VARCHAR (300),
	activity_type VARCHAR(50),
	timings TIME,
	optional_activity TINYINT,
	mandatory_activity TINYINT,
	PRIMARY KEY (activityid)
);


CREATE TABLE ORGANIZES (
	clubid INT NOT NULL,
	activityid INT,
	PRIMARY KEY (clubid, activityid),
	FOREIGN KEY (clubid) REFERENCES CLUB(clubid)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (activityid) REFERENCES ACTIVITY(activityid)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);


CREATE TABLE MODERATOR (
	modid INT NOT NULL,
	studentid INT NOT NULL,
	modname VARCHAR(45) NOT NULL,
	moderator_position VARCHAR(45) NOT NULL,
	PRIMARY KEY (modid),
	FOREIGN KEY (studentid) REFERENCES STUDENT(studentid)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);


CREATE TABLE SUPERVISES (
	modid INT NOT NULL UNIQUE,
	clubid INT NOT NULL,
	PRIMARY KEY (modid, clubid),
	FOREIGN KEY (modid) REFERENCES MODERATOR(modid)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (clubid) REFERENCES CLUB(clubid)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE ACCOUNTS (
	accountid INT AUTO_INCREMENT,
	account_Username VARCHAR(80) NOT NULL,
	account_Password TEXT NOT NULL,
	account_Type VARCHAR(45) NOT NULL,
  account_des VARCHAR(500) NOT NULL,
	email TINYTEXT NOT NULL,
	PRIMARY KEY (accountid)
);

CREATE TABLE PERMISSION (
	permid INT NOT NULL,
	per_name VARCHAR(45) NOT NULL,
	PRIMARY KEY (permid)
);

CREATE TABLE HOLDS (
	accountid INT NOT NULL,
	permid INT NOT NULL,
	PRIMARY KEY(accountid, permid),
	FOREIGN KEY (accountid) REFERENCES ACCOUNTS(accountid)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (permid) REFERENCES PERMISSION(permid)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);


CREATE TABLE MANAGES (
	accountid INT NOT NULL,
	studentid INT UNIQUE,
	clubid INT UNIQUE,
	PRIMARY KEY (clubid, studentid, accountid),
	FOREIGN KEY (clubid) REFERENCES CLUB(clubid),
	FOREIGN KEY (studentid) REFERENCES STUDENT(studentid),
	FOREIGN KEY (accountid) REFERENCES ACCOUNTS(accountid)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	CONSTRAINT only_one_value
		CHECK ((studentid is NULL or clubid is NULL)
        AND NOT (studentid is NULL AND clubid is NULL) )
);

INSERT INTO PERMISSION(permid,per_name) VALUES(3001,'admin');
