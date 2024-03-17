FROM composer:latest

WORKDIR /var/www/coursesAPI

ENTRYPOINT ["composer", "--ignore-platform-reqs"]