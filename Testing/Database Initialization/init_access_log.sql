DROP TABLE IF EXISTS access_log;

CREATE TABLE access_log (
    id int NOT NULL AUTO_INCREMENT,
    user_id int,
    timestamp datetime,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES account(id)
);