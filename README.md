## Database Initialization
SQL files have been included to setup and/or reset the SQL database used throughout the smart manufacturing dashboard, these are located in the [Testing/Database Initialization](Testing/Database%20Initialization) folder. The site requires a minimum of the roles table and at least one administrator account to be functional, although example data is provided for most tables to showcase the site's functionality.


[create_db_w_data.sql](Testing/Database%20Initialization/create_db_w_data.sql) contains the code needed to create the full database for the site, including the example data.

[create_db.sql](Testing/Database%20Initialization/create_db.sql) will \(re\)create the database without any table entries. Note that the site will not be usable in this state, as there are no roles and no accounts to login with.

The init_\<TABLE NAME\>.sql files may be used to initialize and/or reset the data for a single table, without affecting the rest of the database.

Due to the large number of factory logs provided, the SQL code in create_db_w_data.sql and init_factory_log.sql may be too large to run through phpMyAdmin with the default settings. If errors occur after attempting to run the sql code (such as the tables not being populated with entries), the maximum packet size can be increased in the my.ini file, accessed through the XAMPP Control Panel:

![image](https://github.com/user-attachments/assets/d31598da-55af-4683-ad4f-1e7ad98c7580)

![image](https://github.com/user-attachments/assets/de2b7b2a-160c-432a-a654-df76e85e3b7e)

After making this change, the SQL code can be run and should process correctly. \(Note that the SQL statements may still take a while to process.\)

## Accounts
Here is a list of accounts created by the provided SQL files. The site can be viewed by logging in as one of these accounts. Different roles will have access to different versions of the dashboard.
| Username      | Password   | Role                |
| ------------- | ---------- | ------------------- |
| JohnDoe       | password1  | Administrator       |
| JaneDoe       | password2  | Factory Manager     |
| EthanCollins  | password3  | Auditor             |
| WallaceHunter | password4  | Production Operator |
| JeremySmith   | password5  | Administrator       |
| SamuelHayes   | password6  | Auditor             |
| ArthurBarker  | password7  | Factory Manager     |
| BillyMatthews | password8  | Production Operator |
| JayMills      | password9  | Administrator       |
| LoganPorter   | password10 | Auditor             |
| GaugeNielsen  | password11 | Factory Manager     |
| JaylinBarr    | password12 | Production Operator |
