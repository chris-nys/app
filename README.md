# app
Demo App

The idea of this app is to demonstrate a PHP/MySQL connection to display database information through a web browser. The Dockerfile creates a docker image running a CentOS LAMP stack. It also copies over the necessary PHP files and MySQL data.

Index.php queries the database for different words entered, and determines whether that word is the last in the sentence. If it is, it appends an exclamtation point to the end. The php script also logs the user's logins, and displays the login time and source ip address in the footer. 
