Rating System
=============

A Symfony project representing review system


Installation steps
==
`composer install`

`php ./app/console doctrine:database:create`


`php ./app/console doctrine:schema:update --force`

`php ./app/console doctrine:fixtures:load`

Fixtures order is

`php ./app/console doctrine:fixtures:load --append --fixtures=./src/UserBundle/DataFixtures/ORM/LoadUsers.php`
`php ./app/console doctrine:fixtures:load --append --fixtures=./src/ProductBundle/DataFixtures/ORM/LoadProducts.php`
`php ./app/console doctrine:fixtures:load --append --fixtures=./src/ProductBundle/DataFixtures/ORM/LoadReviews.php`

Find hardcoded users (admin & customers) and their credentials in 
`UserBundle\DataFixtures\ORM\LoadUsers.php`


Routes:  `php ./app/console debug:router`

DB credentials (database name as well) can be changed from `./app/config/parameters.yml` if needed.