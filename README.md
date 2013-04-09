Fllat
=====

*An attempt at a flat file database system. Driven by PHP. Stores data in JSON. SQL based data fetching.*

## Introduction

Feel free to test it out somewhat on the [demo page](http://fllat.lfred.info). When you create an account, the data is stored via the database on the server (I'm not sure how secure it is, so don't use a real password). When you log in, the data is retrieved from the database.

The awesomest part is that there are **no running services**, just pure PHP at work.

## Documentation

**For a guide to all of the functions, use [this wiki page](https://github.com/alfredxing/fllat/wiki/Functions).**

## Getting started

Simply pull this git repository or [download the archive](https://github.com/alfredxing/fllat/zipball/master) and run it on a PHP-enabled server.

### Accessing Fllat
To access Fllat from any PHP file, `require` the `fllat.php` file:
```php
require "fllat.php";
```

Now it's time to create and initialize a new database. This is used even if the database exists.
```php
$pie = new Fllat("pie");
```

You can also use relative paths to direct Fllat to where the `db.php` and database folder is:
```php
require("../fllat.php");

$pie = new Fllat("pie", "../db");
```

### Storing data

Storing data into the database you created is easy! Just use one of the data-storing function provided:

#### `add`

Add a row to the database. Input an associative array in the form `"column" => "data"`:
```php
$yum = array("name" => "pepperoni", "size" => "large", "price" => "12.99");
$pie -> add($yum);
```

#### `rw`

Rewrite the entire database table. Takes in an array of associative arrays (a list of rows) to overwrite the database:
```php
$slurp = array("name" => "smoothie", "price" => "4.99");
$chomp = array("name" => "cookie", "price" => "2.99");
$nom = array("name" => "bacon", "price" => "0.00");
$pie -> rw(array($slurp, $chomp, $nom));
```

### Retrieving data

Fllat tries to use some simple and standard data retrieval methods, some of which are adapted from SQL. Here are the basics:

#### `get`

Input a column name, a column name, and a value, and it returns the value of the first column name where (in the same row), the value of the second column name matches the inputted value.
```php
$pie -> get("price", "name", "bacon");  // Returns "0.00"
```

#### `select`

Returns some (or all) columns. Input an array of columns (empty array for all):
```php
$pie -> select(array());  // Returns the whole thing (too long to list here)
$pie -> select(array("name"));  // Returns [["smoothie"],["cookie"],["bacon"]]
```

### Flexibility

Fllat is *extremely* flexibile. Perhaps too much so; it will `json_encode` any data you give it and store it, regardless of what format it's in. This ***will*** cause some errors when retrieving data, so be careful!


## Contributing

Feel free to contribute by creating issues (search to see if the same issue has already been submitted beforehand) and submitting pull requests if you feel comfortable doing so.

## Meta

### Build status
[![Build Status](https://travis-ci.org/fllat/fllat.png?branch=master)](https://travis-ci.org/fllat/fllat)

### Version
Fllat is currently at version `0.1.0`.

### License

Fllat is licensed for use under the terms stated in the [LICENSE.md](https://raw.github.com/alfredxing/fllat/master/LICENSE.md) file.
