DROP TABLE IF EXISTS machine;

CREATE TABLE machine (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(50) NOT NULL,
    note varchar(200),
    ison bool
);

INSERT INTO machine (name, ison) VALUES ('CNC Machine', 1);
INSERT INTO machine (name, ison) VALUES ('3D Printer', 0);
INSERT INTO machine (name, ison) VALUES ('Industrial Robot', 1);
INSERT INTO machine (name, ison) VALUES ('Automated Guided Vehicle', 1);
INSERT INTO machine (name, ison) VALUES ('Smart Conveyor System', 0);
INSERT INTO machine (name, ison) VALUES ('IoT Sensor Hub', 1);
INSERT INTO machine (name, ison) VALUES ('Predictive Maintenance System', 0);
INSERT INTO machine (name, ison) VALUES ('Automated Assembly Line', 0);
INSERT INTO machine (name, ison) VALUES ('Quality Control Scanner', 1);
INSERT INTO machine (name, ison) VALUES ('Energy Management System', 0);