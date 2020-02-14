############################################################
# Dockerfile to build CentOS,Nginx installed  Container
# Based on CentOS
############################################################

# Set the base image to centos
FROM centos:7



# Installing PHP
RUN yum update -y && \
    yum install -y epel-release

RUN yum install -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm && \
    yum install -y yum-utils && \
    rpm --import /etc/pki/rpm-gpg/RPM* && \
    yum-config-manager --enable remi-php73 && \
    yum -y update

# Installing nginx 
ADD nginx.repo /etc/yum.repos.d/nginx.repo
RUN yum -y install nginx


RUN yum install -y php-fpm php-pcel-redis php-xml php-cli php-bcmath php-dba php-gd php-intl php-mbstring php-mysql php-pdo php-soap php-pecl-apcu php-pecl-imagick php-pear php-pecl-json php-opcache php-mysqlnd php-pgsql php-pecl-mongodb php-pecl-sqlite php-pecl-memcache php-pecl-redis php-pecl-memcached php-gettext php-mcrypt php-devel php-mssql php-odbc php-zip 

RUN mkdir -p /run/php-fpm && \
    chown root:apache /run/php-fpm

RUN mkdir -p /var/lib/php/session && \
    chown root:apache /var/lib/php/session

RUN yum clean all

# install pdo
RUN yum -y install pdo_dblib unixODBC freetds redis

# install composer
RUN yum install -y zip unzip
#RUN curl -sS https://getcomposer.org/installer | php
#RUN mv composer.phar /usr/local/bin/composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'e0012edf3e80b6978849f5eff0d4b4e4c79ff1609dd1e613307e16318854d24ae64f26d17af3ef0bf7cfb710ca74755a') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
#RUN ls -al

RUN composer global require hirak/prestissimo
RUN composer global require "fxp/composer-asset-plugin:^1.3.1"

# Installing supervisor
RUN yum install -y python-setuptools
RUN easy_install pip
RUN pip install supervisor

# Adding the configuration file of the nginx
ADD nginx.conf /etc/nginx/nginx.conf
ADD default.conf /etc/nginx/conf.d/default.conf

# Adding the configuration file of the Supervisor
ADD supervisord.conf /etc/

# Adding the default file
# ADD index.php /var/www/index.php

ADD php.ini /etc/php.ini
ADD php-fpm.d-www.conf /etc/php-fpm.d/www.conf

RUN mkdir -p /var/log/supervisor/
# Set the port to 80 
EXPOSE 80 443
WORKDIR /var/www/
# Executing supervisord
CMD ["supervisord", "-n"]

