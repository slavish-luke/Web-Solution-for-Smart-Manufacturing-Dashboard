DROP TABLE IF EXISTS notes;

CREATE TABLE notes (
    note_id INT AUTO_INCREMENT PRIMARY KEY,
    machine_id int,
    user_id_to int NOT NULL,
    user_id_from int NOT NULL,
    notes_subject TEXT,
    notes_content TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO notes (machine_id, user_id_to, user_id_from, notes_subject, notes_content) VALUES (3, 2, 4, 'machine update', 'not working, displaying red light');
INSERT INTO notes (machine_id, user_id_to, user_id_from, notes_content) VALUES (4, 2, 4, 'partially working, displaying yellow light');