DROP TABLE IF EXISTS note;

CREATE TABLE note (
    note_id INT AUTO_INCREMENT PRIMARY KEY,
    machine_id int,
    user_id_to int NOT NULL,
    user_id_from int NOT NULL,
    subject TEXT,
    content TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO note (machine_id, user_id_to, user_id_from, subject, content) VALUES (3, 2, 4, 'machine update', 'not working, displaying red light');
INSERT INTO note (machine_id, user_id_to, user_id_from, content) VALUES (4, 2, 4, 'partially working, displaying yellow light');