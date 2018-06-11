## UsersApp

A user-login application using a file as a memory persistence

## Get started

##### Clone the project

    $ git clone https://github.com/dhvarela/usersapp.git
    $ cd usersapp

##### Pass the composer

    $ composer install

## Usage

##### Pass the tests

PHPUnit has been installed with composer install command

    $ php vendor/bin/phpunit

##### Execute script in command line

Go to the public folder of the project and execute:

    $ php app.php [arg1] [arg2]

* arg1 -> this is the user email to find in the csv file
* arg2 -> this is the password to find in csv file

If user is found, a message will be printed
If user and password are found, an information message will be printed

When user and password are found, the password change to an encrypt password.
If you want to recovery the original file, you should edit it as a CSV file with semicolon separators:

    alfa@mailinator.com;123456
    bravo@mailinator.com;123qwe
    charlie@mailinator.com;poipoi

