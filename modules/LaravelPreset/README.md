# Laravel Essential Preset package

### Install with composer
```composer require akshayjumbade/laravel-preset```

### Run commands to setup
#### Initialize preset 
```php artisan setup```

#### Run below command to seed the neccessory data in DB. 
```php artisan setup --seed```

#### Create Admin setup from below command with assets published
```php artisan admin setup```

#### Create Admin user with below command
```php artisan admin create```

### Geo Locations data
```php artisan geo:setup countries && php artisan geo:setup states && php -d memory_limit=-1 artisan geo:setup cities```

