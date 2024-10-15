DROP TABLE IF EXISTS account;

CREATE TABLE account (
    id int NOT NULL AUTO_INCREMENT,
    username varchar(100) NOT NULL,
    password varchar(60) NOT NULL,
    name varchar(100) NOT NULL,
    email varchar(100),
    notes varchar(10000),
    role_id int NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (role_id) REFERENCES role(id)
);

INSERT INTO account (username, password, name, email, role_id) VALUES ('JohnDoe', 'password1', 'John Doe', 'johndoe@email.com', 1);
INSERT INTO account (username, password, name, email, role_id) VALUES ('JaneDoe', 'password2', 'Jane Doe', 'janedoe@email.com', 3);
INSERT INTO account (username, password, name, email, role_id) VALUES ('EthanCollins', 'password3', 'Ethan Collins', 'ethancollins@email.com', 2);
INSERT INTO account (username, password, name, email, role_id) VALUES ('WallaceHunter', 'password4', 'Wallace Hunter', 'wallacehunter@email.com', 4);
INSERT INTO account (username, password, name, email, role_id) VALUES ('JeremySmith', 'password5', 'Jeremy Smith', 'jeremysmith@email.com', 1);
INSERT INTO account (username, password, name, email, role_id) VALUES ('SamuelHayes', 'password6', 'Samuel Hayes', 'samuelhayes@email.com', 2);
INSERT INTO account (username, password, name, email, role_id) VALUES ('ArthurBarker', 'password7', 'Arthur Barker', 'arthurbarkere@email.com', 3);
INSERT INTO account (username, password, name, email, role_id) VALUES ('BillyMatthews', 'password8', 'Billy Matthews', 'billymatthews@email.com', 4);
INSERT INTO account (username, password, name, email, role_id) VALUES ('JayMills', 'password9', 'Jay Mills', 'jaymills@email.com', 1);
INSERT INTO account (username, password, name, email, role_id) VALUES ('LoganPorter', 'password10', 'Logan Porter', 'loganporter@email.com', 2);
INSERT INTO account (username, password, name, email, role_id) VALUES ('GaugeNielsen', 'password11', 'Gauge Nielsen', 'gaugenielsen@email.com', 3);
INSERT INTO account (username, password, name, email, role_id) VALUES ('JaylinBarr', 'password12', 'Jaylin Barr', 'jaylinbarr@email.com', 4);