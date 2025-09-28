Project Structure
docker-php83/
├── src/
│   ├── index.php         # Home page (role selection: librarian or user)
│   ├── librarian.php     # Librarian dashboard (browse catalog, search, manage borrow/return) (Dejito, Egagamao)
│   ├── user.php          # User catalog (browse/search books, borrow/return) (Dejito, Egagamao)
│   ├── add.php           # Add new book (Eduarte)
│   ├── edit.php          # Edit book details (Domingo)
│   ├── delete.php        # Delete book (Domingo)
│   ├── borrow.php        # Borrow book (Delmonte)
│   ├── return.php        # Return book (Delmonte)
│   ├── style.css         # Shared stylesheet for all pages
│   ├── db.php            # Centralized database connection
│   ├── mysqli-test.php   # MySQLi connection test
│   └── pdo-test.php      # PDO connection test
│
├── mysql-init/
│   └── init.sql          # Database schema + tables + optional seed data
│
├── docker-compose.yml     # Docker services configuration (PHP, MySQL, phpMyAdmin)
├── Dockerfile             # PHP container build instructions
├── docker-cheat-sheet.pdf # Reference guide
└── README.md              # Project overview and instructions
