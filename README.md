<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://zoefin.com/wp-content/uploads/2020/01/zoe_logo_primary.svg" width="400" alt="ZOE Logo"></a></p>

# requirements

- php >= 8.1
- Mysql
- Composer
- Apache or Nginx
* you can use sail to have a docker ready environment

# useful Link

- https://laravel.com/docs/10.x#docker-installation-using-sail

# instalation
## Run the following comands

- composer install
- php artisan key:generate
if your are not using "sail"
- php artisan serve

# Project Explanation

- The mock of the pricing data endpoint is in the file -> app\Models\PricingData.php
- The process of updating the prices is in the job file -> app\Jobs\UpdatePricingData.php
- Unit tests are in the file -> tests\Unit\UpdatePricingDataTest.php
 