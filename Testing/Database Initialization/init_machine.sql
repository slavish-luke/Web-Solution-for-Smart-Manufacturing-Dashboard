DROP TABLE IF EXISTS machine;

CREATE TABLE machine (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    operator_id int,
    note varchar(200),
    ison bool,
    img_address varchar(200),
    PRIMARY KEY (id),
    FOREIGN KEY (operator_id) REFERENCES account(id)
);

INSERT INTO machine (name, ison, img_address) VALUES ('CNC Machine', 1, 'CNC-Machine.jpg');
INSERT INTO machine (name, ison, img_address) VALUES ('3D Printer', 0, '3d-Printer.jpg');
INSERT INTO machine (name, operator_id, ison, img_address) VALUES ('Industrial Robot', 4, 1, 'Industrial-Robot.jpg');
INSERT INTO machine (name, ison, img_address) VALUES ('Automated Guided Vehicle', 1, 'Automated-Guided-Vehicle.jpg');
INSERT INTO machine (name, ison, img_address) VALUES ('Smart Conveyor System', 0, 'Smart-Conveyor-System.jpg');
INSERT INTO machine (name, operator_id, ison, img_address) VALUES ('IoT Sensor Hub', 4, 1, 'IOT-Sensor-Hub.jpg');
INSERT INTO machine (name, operator_id, ison, img_address) VALUES ('Predictive Maintenance System', 4, 0, 'Predictive-Maintenance-System.jpg');
INSERT INTO machine (name, ison, img_address) VALUES ('Automated Assembly Line', 0, 'Automated-Assembly-Line.jpg');
INSERT INTO machine (name, ison, img_address) VALUES ('Quality Control Scanner', 1, 'Quality-Control-Scanner.jpg');
INSERT INTO machine (name, ison, img_address) VALUES ('Energy Management System', 0, 'Energy-Management-System.jpg');