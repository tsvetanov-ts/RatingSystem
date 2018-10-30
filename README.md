Rating System
=============

A Symfony project created on October 29, 2018, 5:34 pm.


Installation steps
==
`composer install`

`php ./app/console doctrine:database:create`


`php ./app/console doctrine:schema:update --force`

`php ./app/console doctrine:fixtures:load`


Find hardcoded users (admin & customers) and their credentials in 
`UserBundle\DataFixtures\ORM\LoadUsers.php`


Routes:  `php ./app/console debug:router`

DB credentials can be changed from `./app/config/parameters.yml` if needed.