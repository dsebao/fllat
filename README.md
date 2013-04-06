Fllat
=====

*An attempt at a flat-file, PHP-driven database system. Data is stored in JSON format.*

## Introduction

Feel free to test it out somewhat on the [demo page](http://fllat.lfred.info). When you create an account, the data is stored via the database on the server (I'm not sure how secure it is, so don't use a real password). When you log in, the data is retrieved from the database.

The awesomest part is that there are **no running services**, just pure PHP at work.

## Getting started

Simply pull this git repository or [download the archive](https://github.com/alfredxing/fllat/zipball/master) and run it on a PHP-enabled server.

### Accessing Fllat
To access Fllat from any PHP file, `require` the `db.php` file:
```php
require("db.php");
```

Now it's time to create and initialize a new database. This is used even if the database exists.
```php
$pie = new Database("pie");
$pie -> go();
```

And you're ready to go! For a guide to the functions (like everything else, still under development), use [this wiki page](https://github.com/alfredxing/fllat/wiki/Functions).

## Contributing

Feel free to contribute by creating issues (search to see if the same issue has already been submitted beforehand) and submitting pull requests if you feel comfortable doing so.
