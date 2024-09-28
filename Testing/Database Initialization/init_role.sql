DROP TABLE IF EXISTS role;

CREATE TABLE role (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(20) NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO role (name) VALUES ('Administrator');
INSERT INTO role (name) VALUES ('Auditor');
INSERT INTO role (name) VALUES ('Factory Manager');
INSERT INTO role (name) VALUES ('Production Operator');