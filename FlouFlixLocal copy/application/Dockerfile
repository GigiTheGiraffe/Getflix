# Dockerfile
FROM php:8.3.9-apache

# Mettre à jour les paquets et installer les dépendances nécessaires pour cURL
RUN apt-get update && apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev && docker-php-ext-install curl

# Installez d'autres extensions nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Copier le code de l'application dans le répertoire par défaut d'Apache
COPY ./source /var/www/html

# Assurez-vous que les permissions sont correctes
RUN chown -R www-data:www-data /var/www/html

# Exposez le port 80 pour le serveur web
EXPOSE 80