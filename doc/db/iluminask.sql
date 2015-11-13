CREATE DATABASE TSW;

USE TSW;

CREATE TABLE USERS(
	ID_USER         	    INTEGER NOT NULL,
	NAME					VARCHAR(20) NOT NULL,
	PASSWORD				VARCHAR(20) NOT NULL,
	EMAIL					VARCHAR(35),

	PRIMARY KEY   (ID_USER)
);

CREATE TABLE POSTS(
    ID_POST		               INTEGER NOT NULL,
	TITLE					   VARCHAR(20) NOT NULL, 
	CONTENT					   VARCHAR(255),
  	DATA                       DATE,
	USER_ID                    INTEGER NOT NULL,

	PRIMARY KEY   (ID_POST),
    FOREIGN KEY   (USER_ID) REFERENCES USERS (ID_USER)
	
);

CREATE TABLE RESPONSES(
	ID_RESPONSE                INTEGER NULL,
	CONTENT				       VARCHAR(255) NOT NULL,
	DATA                       DATE NOT NULL,
	USER_ID 				   INTEGER NOT NULL,
	POST_ID                    INTEGER NOT NULL,

	PRIMARY KEY   (ID_RESPONSE),
	FOREIGN KEY   (USER_ID) REFERENCES USERS (ID_USER),
	FOREIGN KEY	  (POST_ID) REFERENCES POSTS (ID_POST)
);


CREATE TABLE POSTCOMMENTS(
  
	ID_POSTCOMMENT             INTEGER NOT NULL,
	CONTENT        			   VARCHAR(255) NOT NULL,
	DATA                       DATE NOT NULL,
	USER_ID 				   INTEGER NOT NULL,
	POST_ID                    INTEGER NOT NULL,

	PRIMARY KEY   (ID_POSTCOMMENT),
	FOREIGN KEY   (USER_ID) REFERENCES USERS (ID_USER),
	FOREIGN KEY	  (POST_ID) REFERENCES POSTS (ID_POST)
);

CREATE TABLE RESPONSECOMMENTS(
  
	ID_RESPONSECOMMENT         INTEGER NOT NULL,
	CONTENT        			   VARCHAR(255) NOT NULL,
	DATA                       DATE NOT NULL,
	USER_ID 				   INTEGER NOT NULL,
	RESPONSE_ID                INTEGER NOT NULL,

	PRIMARY KEY   (ID_RESPONSECOMMENT),
	FOREIGN KEY   (USER_ID) REFERENCES USERS (ID_USER),
	FOREIGN KEY	  (RESPONSE_ID) REFERENCES RESPONSES (ID_RESPONSE)
);

CREATE TABLE POSTS_USERS(
  
	ID_POST_USERS              INTEGER NOT NULL,
	LIKED        			   BOOLEAN NOT NULL,
	USER_ID 				   INTEGER NOT NULL,
	POST_ID                    INTEGER NOT NULL,

	PRIMARY KEY   (ID_POST_USERS),
	FOREIGN KEY   (USER_ID) REFERENCES USERS (ID_USER),
	FOREIGN KEY	  (POST_ID) REFERENCES POSTS (ID_POST)
);


CREATE TABLE RESPONSES_USERS(
  
	ID_RESPONSE_USER           INTEGER NOT NULL,
	LIKED        			   BOOLEAN NOT NULL,
	USER_ID 				   INTEGER NOT NULL,
	RESPONSE_ID                INTEGER NOT NULL,

	PRIMARY KEY   (ID_RESPONSE_USER),
	FOREIGN KEY   (USER_ID) REFERENCES USERS (ID_USER),
	FOREIGN KEY	  (RESPONSE_ID) REFERENCES RESPONSE (ID_RESPONSE)
);


INSERT INTO `tsw`.`users` (`ID_USER`, `NAME`, `PASSWORD`, `EMAIL`) VALUES ('1', 'Toni', 'toni', 'toni@correo.com'), ('2', 'Eliot', 'eliot', 'eliot@correo.com'), ('3', 'Miguel', 'miguel', 'miguel@correo.com'), ('4', 'Pedro', 'pedro', 'pedro@correo.com'), ('5', 'Silvia', 'silvia', 'silvia@correo.com'); 

INSERT INTO `tsw`.`posts` (`ID_POST`, `TITLE`, `CONTENT`, `DATA`, `USER_ID`) VALUES ('1', 'post1', 'Este post es de Toni', '2015-11-16', '1'),('2', 'post2', 'Este post es de Eliot', '2015-11-13', '2'), ('3', 'post3', 'Este post es de Miguel', '2015-11-12', '3'), ('4', 'post4', 'Este post es de Pedro', '2015-11-19', '4'), ('5', 'post5', 'Este post es de Silvia', '2015-11-20', '5'); 

INSERT INTO `tsw`.`posts_users` (`ID_POST_USERS`, `LIKED`, `USER_ID`, `POST_ID`) VALUES ('1', '1', '1', '3'), ('2', '0', '2', '5'), ('3', '1', '3', '1'); 

INSERT INTO `tsw`.`responses` (`ID_RESPONSE`, `CONTENT`, `DATA`, `USER_ID`, `POST_ID`) VALUES ('1', 'Este es un response de Toni', '2015-11-30', '1', '3'), ('2', 'Este es un response de Miguel', '2015-12-01', '3', '2'), ('3', 'Este es un response de Silvia', '2015-12-09', '4', '5'), ('4', 'Este es un response de Eliot', '2015-12-10', '2', '1'); 

INSERT INTO `tsw`.`responsecomments` (`ID_RESPONSECOMMENT`, `CONTENT`, `DATA`, `USER_ID`, `RESPONSE_ID`) VALUES ('1', 'Este es un responseComment de Pedro', '2015-12-16', '5', '2'), ('2', 'Este es un response Comment de Miguel', '2015-12-28', '3', '1'); 

INSERT INTO `tsw`.`responses_users` (`ID_RESPONSE_USER`, `LIKED`, `USER_ID`, `RESPONSE_ID`) VALUES ('1', '1', '1', '2'), ('2', '0', '3', '1'), ('3', '1', '4', '1'); 