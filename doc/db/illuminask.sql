CREATE DATABASE illuminask;

GRANT ALL PRIVILEGES ON illuminask.* to 'illuminuser'@'localhost' identified by 'illumipass';

USE illuminask;

CREATE TABLE users(
	id INTEGER NOT NULL AUTO_INCREMENT,
	name VARCHAR(20) NOT NULL,
	password VARCHAR(150) NOT NULL,
	email VARCHAR(35),
	fullname VARCHAR(100),
	PRIMARY KEY (id)
);

CREATE TABLE posts(
  id INTEGER NOT NULL AUTO_INCREMENT,
	title VARCHAR(200) NOT NULL,
	content VARCHAR(2000),
  date DATETIME,
	user_id INTEGER NOT NULL,
	votes BIGINT,
	PRIMARY KEY (id),
  FOREIGN KEY(user_id) REFERENCES users (id)

);

CREATE TABLE responses(
	id INTEGER NOT NULL AUTO_INCREMENT,
	content VARCHAR(2000) NOT NULL,
	date DATETIME NOT NULL,
	user_id INTEGER NOT NULL,
	post_id INTEGER NOT NULL,
	votes BIGINT,
	PRIMARY KEY (id),
	FOREIGN KEY (user_id) REFERENCES users (id),
	FOREIGN KEY (post_id) REFERENCES posts (id)
);


CREATE TABLE postcomments(
	id INTEGER NOT NULL AUTO_INCREMENT,
	content VARCHAR(2000) NOT NULL,
	date DATETIME NOT NULL,
	user_id INTEGER NOT NULL,
	post_id INTEGER NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY (user_id) REFERENCES users (id),
	FOREIGN KEY	(post_id) REFERENCES posts (id)
);

CREATE TABLE responsecomments(
	id INTEGER NOT NULL AUTO_INCREMENT,
	content VARCHAR(2000) NOT NULL,
	date DATETIME NOT NULL,
	user_id INTEGER NOT NULL,
	response_id INTEGER NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (user_id) REFERENCES users (id),
	FOREIGN KEY	(response_id) REFERENCES responses (id)
);

CREATE TABLE post_votes(
	id INTEGER NOT NULL AUTO_INCREMENT,
	liked BOOLEAN NOT NULL,
	user_id INTEGER NOT NULL,
	post_id INTEGER NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (user_id) REFERENCES users (id),
	FOREIGN KEY	(post_id) REFERENCES posts (id)
);

CREATE TABLE post_visits(
	id INTEGER NOT NULL AUTO_INCREMENT,
	user_id INTEGER NOT NULL,
	post_id INTEGER NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (user_id) REFERENCES users (id),
	FOREIGN KEY	(post_id) REFERENCES posts (id)
);


CREATE TABLE response_votes(
	id INTEGER NOT NULL AUTO_INCREMENT,
	liked BOOLEAN NOT NULL,
	user_id INTEGER NOT NULL,
	response_id INTEGER NOT NULL,
	PRIMARY KEY (id),
	FOREIGN KEY (user_id) REFERENCES users (id),
	FOREIGN KEY (response_id) REFERENCES responses (id)
);


INSERT INTO users (name, password, email, fullname) VALUES
('Toni', 'toni', 'toni@correo.com', 'Antonio Ferreiro'),
('Eliot', 'eliot', 'eliot@correo.com', 'Eliot Blanco'),
('Miguel', 'miguel', 'miguel@correo.com', 'Miguel Vaamonde'),
('Pedro', 'pedro', 'pedro@correo.com', 'Pedro Garcia'),
('Silvia', 'silvia', 'silvia@correo.com', 'Silvia Garcia');

INSERT INTO posts (title, content, date, user_id, votes) VALUES
('post1', 'Este post es de Toni', '2015-11-16 18:00:00', '1', 1),
('post2', 'Este post es de Eliot', '2015-11-13 18:00:00', '2', 0),
('post3', 'Este post es de Miguel', '2015-11-12 18:00:00', '3', 1),
('post4', 'Este post es de Pedro', '2015-11-19 18:00:00', '4', 0),
('post5', 'Este post es de Silvia', '2015-11-20 18:00:00', '5', -1);

INSERT INTO post_votes (liked, user_id, post_id) VALUES
('1', '1', '3'),
('0', '2', '5'),
('1', '3', '1');

INSERT INTO responses (content, date, user_id, post_id, votes) VALUES
('Este es un response de Toni', '2015-11-30 18:00:00', '1', '3', 0),
('Este es un response de Miguel', '2015-12-01 18:00:00', '3', '2', 1),
('Este es un response de Silvia', '2015-12-09 18:00:00', '4', '5', 0),
('Este es un response de Eliot', '2015-12-10 18:00:00', '2', '1', 0);

INSERT INTO responsecomments (content, date, user_id, response_id) VALUES
('Este es un responseComment de Pedro', '2015-12-16 18:00:00', '5', '2'),
('Este es un response Comment de Miguel', '2015-12-28 18:00:00', '3', '1');

INSERT INTO response_votes (liked, user_id, response_id) VALUES
('1', '1', '2'),
('0', '3', '1'),
('1', '4', '1');
