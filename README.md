Ultimo
1.	Bouw een nieuwe versie van linode/lamp via een Dockerfile

C:\Users\Eigenaar\Dropbox\Documenten\GitLab\CRM staat dockerfile

Docker build -t lichtje:v1 .

Resultaat: een image waar ook php-files, sql file, python, php.ini files en inloggegevens in staan.

RUN
docker run -p 80:80 -v database:/var/lib/mysql -t -i lichtje:v1

2.	Eenmalig: Vul de database en maak user aan die rechten heeft.

mysql -uroot -pAdmin2015

CREATE USER 'g7triage'@'localhost' IDENTIFIED BY 'TriageCRM';
GRANT ALL PRIVILEGES ON * . * TO 'g7triage'@'localhost';

//controle: SELECT User FROM mysql.user;

CREATE DATABASE g7bedrijfsadmin;
USE g7bedrijfsadmin
source /usr/crm/crm.sql;

3. Vanaf deze eerste keer is het niet meer nodig om de database te vullen. Deze is namelijk gekoppeld met een virtuele volume (database).

Voor het aanpassen van PHP files zal telkens een nieuwe variant van de build gemaakt moeten worden. Het is ook mogelijk om een tweede volume toe te voegen waarbij je de public_html (root directory) koppelt aan een directory op je PC.

Dan wordt de RUN mogelijk:
docker run -p 80:80 -v database:/var/lib/mysql -v /c/Users/Eigenaar/Dropbox/Documenten/Gitlab/CRM/files:/home -t -i lichtje:v1

Om dan live PHP files aan te passen moet je eerst naar de standaard directory gaan:
cd var/www/example.com/public_html
Dan kopi�ren potentiele nieuwe files naar de root directory:
cp -R /home/* .
