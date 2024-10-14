DROP TABLE IF EXISTS account;

CREATE TABLE account (
    id int NOT NULL AUTO_INCREMENT,
    username varchar(100) NOT NULL,
    password varchar(60) NOT NULL,
    email varchar(100),
    name varchar(100) NOT NULL,
    role_id int NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (role_id) REFERENCES role(id)
);

INSERT INTO account (username, password, email, name, role_id) VALUES ('JohnDoe', 'password1', 'johndoe@email.com', 'John Doe', 1);
INSERT INTO account (username, password, email, name, role_id) VALUES ('JaneDoe', 'password2', 'janedoe@email.com', 'Jane Doe', 3);
INSERT INTO account (username, password, email, name, role_id) VALUES ('EthanCollins', 'password3', 'ethancollins@email.com', 'Ethan Collins', 2);
INSERT INTO account (username, password, email, name, role_id) VALUES ('WallaceHunter', 'password4', 'wallacehunter@email.com', 'Wallace Hunter', 4);