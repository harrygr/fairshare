# FairShare

**FairShare is a webapp built on [Laravel](http://laravel.com/) for squaring up shared payments between a group of people.**
A household or group has a single, shared login and adds payers to the account. Whenever a group payment is made it is entered in, specifying who paid what and who is included in the payment.

The statement page will show a summary of all the payments included how much each payer owes. There is also a settling-up calculator which works out the most efficient way to square everyone up.

### Requirements

Basically the same as what [Laravel needs](http://laravel.com/docs/installation#server-requirements): a working webserver with PHP 5.4+ and a database.

### Install

- Clone into your working directory
- Creat and populate a `.env.environment.php` file with the app config. (See `.env.example.php`).
- Run `composer install` (with globally-installed composer of course). This will install all the dependencies
- Run `php artisan migrate` to generate the tables in your database
- (Optional) `php artisan db:seed` to populate with demo data.

### Development
 
Front-end is [Twitter Bootstrap](http://getbootstrap.com/).
Feel free to fork and submit pull-requests for improvements and bug fixes.

Demo/working deployment at [http://fairshare.harryg.me](http://fairshare.harryg.me).

### License

FairShare is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
