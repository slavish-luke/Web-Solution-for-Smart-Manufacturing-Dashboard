DROP TABLE IF EXISTS task;

CREATE TABLE task (
    id int NOT NULL AUTO_INCREMENT,
    complete bool NOT NULL DEFAULT false,
    job_desc varchar(1000) NOT NULL,
    operator_id int,
    machine_id int,
    PRIMARY KEY (id),
    FOREIGN KEY (operator_id) REFERENCES account(id),
    FOREIGN KEY (machine_id) REFERENCES machine(id)
);

INSERT INTO task (job_desc, operator_id, machine_id) VALUES ('Create 35 units', 4, 2);
INSERT INTO task (job_desc, operator_id, machine_id) VALUES ('Repair arm', 4, 3);
INSERT INTO task (job_desc, operator_id, machine_id) VALUES ('Check connection', 4, 6);
