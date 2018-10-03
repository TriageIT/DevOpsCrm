FROM linode/lamp

RUN apt-get update && \
      apt-get -y install sudo

RUN apt-get -y install python
RUN apt-get -y install python-mysqldb
RUN apt-get -y install php5-mysql
#RUN apt-get -y install npm - doe ik pas iets mee met installatie van cypress
#RUN npm init -y

#Hier doe ik nog niets mee:
ARG USER="root"
ARG PASSWORD="Admin2015"

RUN mkdir -p /usr/crm
RUN mkdir -p /var/www/triageinc
RUN mkdir -p /CRM/project && cd /CRM/project



ADD crm.sql /usr/crm
ADD ./files /var/www/example.com/public_html
ADD ./triageinc /var/www/triageinc

#ADD ./phpapache /etc/php5/apache2/
#ADD ./phpcli /etc/php5/cli/
