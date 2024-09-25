SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS dashboard;
CREATE DATABASE dashboard;

USE dashboard;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON dashboard TO dbadmin@localhost;