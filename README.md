# ATLANTIS | AVOCAT
The missing law firm management system.
Website Demo: [https://demo.atlantisavocat.creativesolutionsfactory.com](https://demo.atlantisavocat.creativesolutionsfactory.com). 
The demo has limited permissions. Install locally for full access.

## Installation

1. Clone the repo and `cd` into it
1. `composer update`
1. `composer install`
1. Rename or copy `.env.example` file to `.env`
1. Use the following commands
1. `php artisan key:generate`
1. Set your database credentials in your `.env` file
1. Set your `APP_URL` to `http://localhost:8000` in your `.env` file. This is needed for Voyager to correctly resolve asset URLs.
1. Set `ADMIN_PASSWORD` in your `.env` file if you want to specify an admin password. If not, the default password is 'password'
1. `php artisan site:install`. This will migrate the database and run any seeders necessary.
1. `php artisan serve` or use Laravel Valet or Laravel Homestead
1. Visit `localhost:8000` in your browser
1. Login or visit `/vvci/login` to access the Dashboard.
1. Admin User/Password: `admin@app.com/password`.
1. Avocat Web User/Password: `avocat@app.com/password`.
1. Collaborateur 1 Web User/Password: `col1@app.com/password`.
1. Collaborateur 2 Web User/Password: `col2@app.com/password`.
1. Client 1 Web User/Password: `client1@app.com/password`.

## Characteristics

1. Security and Confidentiality

    - Server security

    - Application security

    - Security of confidential data

    - Security of access rights roles and permissions

    - Traceability system

1. BREAD operations

    - Browse / Read / Edit / Add / Delete = BREAD

## Modules

1. Users:

    - Admin: Administrator (Full Access to the App  Browse / Read / Edit / Add / Delete / Restore deleted)

    - Lawyer: Master Lawyer (Access to the App  Browse / Read / Edit / Add / Delete)

    - Collaborator: Employees, interns, etc. ( Browse / Read / Edit / Add)

    - Client: Customers (Access to the App  Browse / Read)

1. Contacts module:

    - Assignment of roles in files (Client, Adversary, etc.)

    - BREAD contacts (lawyers, collaborators, clients, Adversary, ...)

1. Lawsuits module:

    - Unified management of files

    - automatisation

    - BREAD lawsuits

    - BREAD stages

    - BREAD attachements

    - Monitoring of case progress


1. Calendar module:

    - Events (Hearings, appointments, tasks and deadlines)

    - Multi-user calendar sharing

1. Alerts & Notifications module:

    - Alerts & Notifications of each BREAD

    - Alerts & Notifications of important events

## Scheduled updates

1. Lawsuits module:

    - Automatic generation of standard documents from template

1. Invoicing module:

    - Time, package or result billing

    - Management of expenses and disbursements

    - Non-billable time management

    - Monitoring of unpaid invoices

    - Automatic generation of invoices

1. Accounting module:

    - Recipe journal

    - Entering income and expenses

    - VAT declaration


1. Statistics module:

    - Time spent by employees

    - Number of files in progress, classified, archived

    - Billable, invoiced, paid time ...
