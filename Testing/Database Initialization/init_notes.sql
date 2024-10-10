DROP TABLE IF EXISTS notes;

CREATE TABLE notes (
    note_id INT AUTO_INCREMENT PRIMARY KEY,
    machine_id int,
    user_id int NOT NULL,
    notes_content TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO notes (machine_id, user_id, notes_content) VALUES (3, 2, 'not working, displaying red light');
INSERT INTO notes (machine_id, user_id, notes_content) VALUES (4, 2, 'partially working, displaying yellow light');