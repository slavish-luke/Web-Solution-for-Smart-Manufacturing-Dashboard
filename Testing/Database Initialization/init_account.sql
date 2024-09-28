DROP TABLE IF EXISTS account;

CREATE TABLE account (
    id int NOT NULL AUTO_INCREMENT,
    username varchar(100) NOT NULL,
    password varchar(60) NOT NULL,
    role_id int NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (role_id) REFERENCES role(id)
);

INSERT INTO account (username, password, role_id) VALUES ('JohnDoe', 'password1', 1);
INSERT INTO account (username, password, role_id) VALUES ('JaneDoe', 'password2', 3);
INSERT INTO account (username, password, role_id) VALUES ('EthanCollins', 'password3', 2);
INSERT INTO account (username, password, role_id) VALUES ('WallaceHunter', 'password4', 4);