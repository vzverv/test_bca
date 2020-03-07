#Test task for BCA

# Bootstrap
Do *composer install* to have autoload and install PHPUnit with a nice printer
then do *docker-compose up -d* to run the site via docker
to run tests from outside of container *docker exec bca_bca-api-php-fpm_1 vendor/bin/phpunit* or
go inside of container *docker exec -ti {container id/container name} bash* and run *vendor/bin/phpunit*

#Composer
In this project composer is used only for autoload and PHPUnit. The autoload could be done with spl_autoload_register()
but I find it nicer to use the PSR-4 autoload.

# index.php

I like to keep the entry point clean, so I moved routes to a dedicated file in config

#Router
To simplify the code and because it is a test routes do not support uris like 'api/v1/client/{1}', all parameters 
should be send as regular query parameters 

#Controllers
I use invokable controllers - they have only one function: link request, business logic and response.
Each controller has only one responsibility.

#DTO
DTO allows us decouple database structure from the response. Should we change any parameters in payload it will be done 
easily in DTO without touching db schema.

#Persistence layer

I separate read and write models to respect CQRS principle.
Write models should be accessed via a service from the app layer (UseCase), at the same time the read model usually 
doesn't need to process data - it simply retrieves it from the data storage. 

#Because it is a test task I skipped some moments: 
- I do not implement PSR7 interfaces
- I didn't create an entity Client