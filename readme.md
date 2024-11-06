1. index.php - **entry point**, require *database class, twig, router*.
2. router/web.php - simple router, that **catch url and include files by switch-case**.
3. views/ - dir which **contain** twig **templates** and form
4. database/DatabaseConnection.php - realised **singleton pattern** to DB connection.*
5. controllers/UserController.php - class, called by the **router**, manages user operations, interacts with the **User model**, and uses **Twig** for rendering views, supporting actions like **displaying, adding, deleting users, and pagination**.
6. models/User.php - class **handles database operations via PDO**, with methods for **adding, retrieving, and deleting users**, simplifying data handling for the controller.
7. migrations approach:
- create_migration.php - by *file_put_contents()* create migration class with *up() and down() methods*. Put it into migrations dir.
- migrate.php - **create migrations DB**(if it's need) and check executed migration's, **execute up() method of non-executed migrations** and put it's to the table.
- rollback - *execute down() method* of last migration, **delete those from the table**.
