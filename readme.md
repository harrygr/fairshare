# Larpay

**Larpay is a webapp built on [Laravel](http://laravel.com/) for squaring up shared payments between a group of people.**
A household or group has a single, shared login and adds payers to the account. Whenever a group payment is made it is entered in, specifying who paid what and who is included in the payment.

The statement page will show a summary of all the payments included how much each payer owes. There is also a settling-up calculator which works out the most efficient way to square everyone up.

### Requirements

Basically the same as what [Laravel needs](http://laravel.com/docs/installation#server-requirements): a working webserver with PHP 5+ and a MySQL database. I have plans however to switch to SQLite although you are free to choose your database in the Laravel config.

### Development

Has some basic CRUD features with more to be added. 
Payment logic is there and additional features are coming.
Front-end is [Twitter Bootstrap](http://getbootstrap.com/).
Feel free to fork and submit pull-requests for improvements and bug fixes.

Demo to come soon.

### License

Larpay is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
