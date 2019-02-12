Ultimo
1.	Bouw een nieuwe versie van linode/lamp via een Dockerfile

C:\Users\Eigenaar\Dropbox\Documenten\GitLab\CRM staat dockerfile

Docker build -t lichtje:v3 .

Resultaat: een image waar ook php-files, sql file, python, php.ini files en inloggegevens in staan.

RUN 

docker run -p 80:80 -v /c/Users/Eigenaar/Dropbox/Documenten/Gitlab/CRM/files:/home -t -i lichtje:v3 /bin/bash

2. 	Ga de services starten

service apache2 start

service mysql start

3.	Vul de database en maak user aan die rechten heeft.

mysql -u root -p

  //het PASSWORD is Admin2015

CREATE USER 'g7triage'@'localhost' IDENTIFIED BY 'TriageCRM';

GRANT ALL PRIVILEGES ON * . * TO 'g7triage'@'localhost';

//controle: SELECT User FROM mysql.user;

CREATE DATABASE g7bedrijfsadmin;


USE g7bedrijfsadmin


source /usr/crm/crm.sql;


Eerst naar de standaard directory gaan:

cd var/www/example.com/public_html

Dan kopi�ren potentiele nieuwe files anaar de root directory:

cp -R /home/* .
