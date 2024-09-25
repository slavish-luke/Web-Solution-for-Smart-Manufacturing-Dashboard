DROP TABLE IF EXISTS account;

CREATE TABLE account (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username varchar(100) NOT NULL,
    password varchar(100) NOT NULL
);

INSERT INTO account (username, password) VALUES ('JohnDoe', 'password1');
INSERT INTO account (username, password) VALUES ('JaneDoe', 'password2');
INSERT INTO account (username, password) VALUES ('EthanCollins', 'password3');
INSERT INTO account (username, password) VALUES ('WallaceHunter', 'password4');