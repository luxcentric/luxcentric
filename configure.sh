#!/bin/bash

docker exec -t luxcentric_wordpress_1 a2enmod ssl
docker exec -t luxcentric_wordpress_1 sed -i "s/\/etc\/ssl\/certs\/ssl-cert-snakeoil\.pem/\/certs\/server\.crt/g" /etc/apache2/sites-available/default-ssl.conf
docker exec -t luxcentric_wordpress_1 sed -i "s/\/etc\/ssl\/private\/ssl-cert-snakeoil.key/\/certs\/server\.key/g" /etc/apache2/sites-available/default-ssl.conf
docker exec -t luxcentric_wordpress_1  a2ensite default-ssl.conf

docker-compose restart wordpress

