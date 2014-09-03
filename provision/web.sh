#!/bin/bash
# Jose Aguado
# 15/08/2014
# chmod +x .sh

echo "Provisioning virtual machine WEB ..."

sudo su

# Git
echo "Update/Upgrade System"
apt-get update
#apt-get upgrade -y

sudo dpkg --configure -a --by-package

#instalar el idioma español
echo "Install Spanish language - locales"
cd /usr/share/locales/
./install-language-pack es_ES

dpkg-reconfigure locales
locale-gen es_ES.UTF-8

sudo apt-get install python-software-properties -y
sudo add-apt-repository ppa:ondrej/php5-oldstable
sudo apt-get update
sudo apt-cache policy php5

# Install App Basic
echo "Install App Basic"
apt-get install bash gcc curl unzip -y

# Apache
echo "Installing Apache"
apt-get install apache2 -y

echo "Installing PHP"
apt-get install php5-common php5-dev php5-cli -y

echo "Installing PHP extensions"
apt-get install php5-curl php5-gd php5-mcrypt php5-mysql libapache2-mod-php5 php5-intl php-gettext -y

echo "Composer"
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# MySQL
echo "Preparing MySQL"
apt-get install debconf-utils -y
debconf-set-selections <<< "mysql-server mysql-server/root_password password 1234"
debconf-set-selections <<< "mysql-server mysql-server/root_password_again password 1234"

echo "Installing MySQL"
apt-get install mysql-server -y

#netstat -tap | grep apache
#netstat -tap | grep mysql

echo "Remote Allow"
sudo sed -i "s/bind-address/#bind-address/g" /etc/mysql/my.cnf
sudo sed -i "s/skip-external-locking/#skip-external-locking/g" /etc/mysql/my.cnf

echo "Setting up our MySQL user and db"
sudo mysql -uroot -p1234 -e "CREATE DATABASE test"
sudo mysql -uroot -p1234 -e "grant all privileges on test.* to 'root'@'%' identified by '1234'"

#echo "Setting db TABLES"
sudo mysql -uroot -p1234 test < /vagrant/provision/files/database.sql

# Apache Configuration SSL
sudo a2enmod ssl
#sudo a2ensite default-ssl

# rewrite (Todo SSL)
sudo a2enmod rewrite

echo "Allowing Apache override to all"
sudo sed -i "s/AllowOverride None/AllowOverride All/g" /etc/apache2/apache2.conf

# lo añadimos como root para poder ejecutar programas externos como root
adduser www-data root
adduser vagrant root

# Apache Configuration
echo "Configuring Apache .dev"
sudo cp /vagrant/provision/config/web.dev /etc/apache2/sites-available/web.dev > /dev/null
sudo a2ensite web.dev
sudo a2dissite default

sudo service apache2 restart

echo 'phpmyadmin phpmyadmin/dbconfig-install boolean false' | debconf-set-selections
echo 'phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2' | debconf-set-selections

echo 'phpmyadmin phpmyadmin/app-password-confirm password 1234' | debconf-set-selections
echo 'phpmyadmin phpmyadmin/mysql/admin-pass password 1234' | debconf-set-selections
echo 'phpmyadmin phpmyadmin/password-confirm password 1234' | debconf-set-selections
echo 'phpmyadmin phpmyadmin/setup-password password 1234' | debconf-set-selections
echo 'phpmyadmin phpmyadmin/database-type select mysql' | debconf-set-selections
echo 'phpmyadmin phpmyadmin/mysql/app-pass password 1234' | debconf-set-selections

echo 'dbconfig-common dbconfig-common/mysql/app-pass password 1234' | debconf-set-selections
echo 'dbconfig-common dbconfig-common/password-confirm password 1234' | debconf-set-selections
echo 'dbconfig-common dbconfig-common/app-password-confirm password 1234' | debconf-set-selections
echo 'dbconfig-common dbconfig-common/app-password-confirm password 1234' | debconf-set-selections
echo 'dbconfig-common dbconfig-common/password-confirm password 1234' | debconf-set-selections

apt-get install phpmyadmin -y

sudo service apache2 restart
sudo service mysql restart

# Install Laravel 4

# New Install
# cd /var/www
# wget https://github.com/laravel/laravel/archive/master.zip
# unzip master.zip && cd laravel-master/ && mv * ../ && cd ..
# rm -r laravel-master && rm master.zip

# Update Installation
cd /var/www
sudo composer install

sudo chmod -R 777 app/storage

sudo service apache2 restart

echo "Finished provisioning."