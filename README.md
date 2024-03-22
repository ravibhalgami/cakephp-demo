# CakePHP User Onboarding Process

This is a CakePHP application that demonstrates a user onboarding process. The application allows users to register, login, and access protected resources.

## Getting Started

Follow these instructions to set up and run the application locally.

### Prerequisites

- PHP >= 5.3
- MySQL or another compatible database
- Composer

### Installation

#### Clone the repository:

`git clone https://github.com/bhalgamiravi/cakephp_demo.git`

#### Navigate to the project directory:

` cd cakephp_demo`

#### Create a temp folder in app Folder:

` mkdir app/tmp`

#### Give permission to that tmp folder:

` chmod 777 -Rf app/tmp`

#### Install dependencies:

`composer install`

#### Configure your database connection:

- Copy app/Config/database.php.default to app/Config/database.php.
- Update the database configuration in app/Config/database.php with your database credentials.
- Execute sql file from : app/Config/Schema/setup.sql

# Usage

## Registration:

## Navigate to /signup.

Fill out the registration form and submit.

### Login:

Navigate to /signin.
Enter your credentials and submit.

### Protected Resources:

User list is a protected resource. If not logged in, you'll be redirected to the login page.

User Edit/Delete are protected and only admin user role can access it.
