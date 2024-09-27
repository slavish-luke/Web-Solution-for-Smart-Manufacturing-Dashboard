SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS smart_manufacturing_dashboard;
CREATE DATABASE smart_manufacturing_dashboard;

USE smart_manufacturing_dashboard;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON dashboard.account TO dbadmin@localhost;
GRANT all privileges ON dashboard.machine TO dbadmin@localhost;
GRANT all privileges ON dashboard.factory_log TO dbadmin@localhost;