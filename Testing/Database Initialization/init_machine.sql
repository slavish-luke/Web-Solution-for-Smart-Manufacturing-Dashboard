DROP TABLE IF EXISTS machine;

CREATE TABLE machine (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(20) NOT NULL
);

INSERT INTO machine (name) VALUES ('CNC Machine');
INSERT INTO machine (name) VALUES ('3D Printer');
INSERT INTO machine (name) VALUES ('Industrial Robot');
INSERT INTO machine (name) VALUES ('Automated Guided Vehicle');
INSERT INTO machine (name) VALUES ('Smart Conveyor System');
INSERT INTO machine (name) VALUES ('IoT Sensor Hub');
INSERT INTO machine (name) VALUES ('Predictive Maintenance System');
INSERT INTO machine (name) VALUES ('Automated Assembly Line');
INSERT INTO machine (name) VALUES ('Quality Control Scanner');
INSERT INTO machine (name) VALUES ('Energy Management System');