SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS smart_manufacturing_dashboard;
CREATE DATABASE smart_manufacturing_dashboard;

USE smart_manufacturing_dashboard;

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT ALL privileges ON smart_manufacturing_dashboard.* TO dbadmin@localhost;