1. index.php - **entry point**, require *database class, twig, router*.
2. router/web.php - simple router, that **catch url and include files by switch-case**.
3. views/ - dir which **contain** twig **templates** and form
4. database/Database.php - realised **singleton pattern** to DB connection, also have *getUser() and setUser() methods.*
5. addUser.php - catch data *from* form and **set user** in DB.
6. migrations approach:
- create_migration.php - by *file_put_contents()* create migration class with *up() and down() methods*. Put it into migrations dir.
- migrate.php - **create migrations DB**(if it's need) and check executed migration's, **execute up() method of non-executed migrations** and put it's to the table.
- rollback - *execute down() method* of last migration, **delete those from the table**.
