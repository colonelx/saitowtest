FROM ubuntu:16.04

ENV DEBIAN_FRONTEND=noninteractive
ENV LANG=C.UTF-8

RUN apt-get update && \
	apt-get install -y \
	  software-properties-common \
	  python-software-properties

RUN add-apt-repository ppa:ondrej/php -y
RUN apt-key adv --keyserver keyserver.ubuntu.com --recv-keys 4F4EA0AAE5267A6C

RUN apt-get update && \
    apt-get install -y \
      apache2 \
      php5.6 \
      php5.6-cli \
      libapache2-mod-php5.6 \
      php5.6-gd \
      php5.6-ldap \
      php5.6-mcrypt \
      php5.6-zip \
      php5.6-xml \
      php5.6-sqlite3 \
      curl \
      git
      
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY apache_default /etc/apache2/sites-available/000-default.conf
COPY run /usr/local/bin/run
RUN chmod +x /usr/local/bin/run
RUN a2enmod rewrite

# Add nginx volumes
VOLUME ["/var/www"]

# Set the work directory
WORKDIR /var/www

EXPOSE 80
CMD ["/usr/local/bin/run"]
