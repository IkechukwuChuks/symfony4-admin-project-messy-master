# Symfony Admin Project
_Symfony version 4.4_

#### Setup instructions:
To fetch all composer dependencies
```shell script
composer install
```
To get necessary node dependencies
```shell script
yarn install --frozen-lockfile
```
To compile assets
```shell script
yarn dev
```
To watch and compile assets when js or css files change
```shell script
yarn watch
```
To get database connection in place
```text
1. Create your .env.local file (see .env file for example)
2. Create your mysql database
3. Update DATABASE_URL variable to reflect your specific configurations (dbname, user, password, mysql port)
4. Populate your database by running migrations - ./bin/console doctrine:migrations:migrate
```

### Static Analysis ###
To run PHPStan execute command:
```shell script
vendor/bin/phpstan analyse src tests --level max
OR
composer phpstan
```

### Run on Docker ###
To launch project on docker, run
```shell script
cd ./docker && docker-compose up
```

You can now access project in browser using: http://localhost:80

To run Symfony commands execute frock `docker` directory:
```shell script
docker-compose exec php-fpm php bin/console <command>
```

Run tests with:
```shell script
docker-compose exec php-fpm php bin/phpunit
```

### Issues ###

1. `/admin/login` is not working ("Too many redirects") => solved => now changed to `/login`
2. 500 error when creating user with the same username. => solved => user cannot be created if username exists
3. Deleted user should not be able to login. => solved => deleted user is automatically redirected back to `/login`
4. User should not be able to delete himself. => solved => user cannot delete him/herself
5. User passwords shouldn't be stored in plaintext. => solved => user passwords now encoded when created
6. User can't be deleted by superadmin => solved => user can now be deleted by superadmin
7. `/superadmin` routes should be accessible only to the super admin, now admin is able to access `/superadmin/home` => solved => only superadmin can access `/superadmin` routes
8. `/admin/login` is not working ("Too many redirects") => solved => now changed to `/login`
9. After login ROLE_ADMIN must be redirect to User list, while ROLE_SUPER_ADMIN to `/superadmin/home` => solved => after login ROLE_ADMIN redirects to `/admin/` and ROLE_SUPER_ADMIN redirects to `/superadmin/home`

### All Issues Cleared Successfully ###