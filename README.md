# Brewery

This is a backend api project to provide data about beers and beweries for webapps.

## Description

Brewery project consist an api for search  and provide information about every kind of beers or breweries.

## Requeriments

You need install this softwares in your computer.

    $ php  5.6 or higher

    $ git client

## Manual Installation

Clone the repository project:

``` bash
    $ git clone https://github.com/renandanton/brewery-api.git
```

Enter in project directory,

``` bash
    $ cd brewery-api
```

And then execute:

``` bash
    $ composer install
```

and finally run the web server:

``` bash
    $ composer serve
```

## How to use

There are two routes

| Verb     | Route    |  Param  1    |  Param 2     |
| :------: |:--------:| :-----------:| :-----------:|
| GET      | /random  |   none       |  none        |
| GET      | /search  |  q = string  | type = string|


### Get a random beer:

``` bash
curl -X GET -H "Content-Type: application/json" http://localhost:8080/random
```

### Search a specific beer:

``` bash
curl -X GET -H "Content-Type: application/json" http://localhost:8080/search?q=Smithwicks&type=beer
```

## Testing

If you want run unit tests in brewery api type this command on terminal:

``` bash
  $ composer test
```

## Contributing

Bug reports and pull requests are welcome on GitHub at https://github.com/renandanton/brewery-api.git. This project is intended to be a safe, welcoming space for collaboration, and contributors are expected to adhere to the [Contributor Covenant](http://contributor-covenant.org) code of conduct.


## License

The gem is available as open source under the terms of the [MIT License](http://opensource.org/licenses/MIT).
