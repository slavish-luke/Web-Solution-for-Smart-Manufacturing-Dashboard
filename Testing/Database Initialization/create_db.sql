SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS smart_manufacturing_dashboard;
CREATE DATABASE smart_manufacturing_dashboard;

USE smart_manufacturing_dashboard;

CREATE TABLE role (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(20) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE account (
    id int NOT NULL AUTO_INCREMENT,
    username varchar(100) NOT NULL,
    password varchar(60) NOT NULL,
    role_id int NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (role_id) REFERENCES role(id)
);

CREATE TABLE machine (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    img_address varchar(200),
    operator_id int,
    note varchar(200),
    ison bool,
    temperature decimal(4, 2),
    pressure decimal(4, 2),
    vibration decimal(3, 2),
    humidity decimal(4, 2),
    power_consumption decimal(5, 2),
    operational_status varchar(20),
    error_code char(4),
    production_count int(3),
    maintenance_log varchar(20),
    speed decimal(3, 2),
    PRIMARY KEY (id),
    FOREIGN KEY (operator_id) REFERENCES account(id)
);

CREATE TABLE factory_log (
    id int NOT NULL AUTO_INCREMENT,
    machine_id int NOT NULL,
    timestamp datetime NOT NULL,
    temperature decimal(4, 2),
    pressure decimal(4, 2),
    vibration decimal(3, 2),
    humidity decimal(4, 2),
    power_consumption decimal(5, 2),
    operational_status varchar(20),
    error_code char(4),
    production_count int(3),
    maintenance_log varchar(20),
    speed decimal(3, 2),
    PRIMARY KEY (id),
    FOREIGN KEY (machine_id) REFERENCES machine(id)
);

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT ALL privileges ON smart_manufacturing_dashboard.* TO dbadmin@localhost;