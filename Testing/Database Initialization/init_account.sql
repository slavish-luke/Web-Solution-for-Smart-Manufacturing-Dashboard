DROP TABLE IF EXISTS account;

CREATE TABLE account (
    id int NOT NULL AUTO_INCREMENT,
    username varchar(100) NOT NULL,
    password varchar(60) NOT NULL,
    name varchar(100) NOT NULL,
    email varchar(100),
    role_id int NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (role_id) REFERENCES role(id)
);

INSERT INTO account (username, password, name, email, role_id) VALUES ('JohnDoe', 'password1', 'John Doe', 'johndoe@email.com', 1);
INSERT INTO account (username, password, name, email, role_id) VALUES ('JaneDoe', 'password2', 'Jane Doe', 'janedoe@email.com', 3);
INSERT INTO account (username, password, name, email, role_id) VALUES ('EthanCollins', 'password3', 'Ethan Collins', 'ethancollins@email.com', 2);
INSERT INTO account (username, password, name, email, role_id) VALUES ('WallaceHunter', 'password4', 'Wallace Hunter', 'wallacehunter@email.com', 4);