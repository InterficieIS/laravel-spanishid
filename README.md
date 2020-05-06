# SpanishID for Laravel 6.X|7.X

Library to add validations for spanish state-emitted identity document numbers, including
 NIF, CIF, NIE and Social Security Number (SSN). 

## Installation

Require this package with composer:

```
composer require interficie/identity
```

## Usage

You can now check a document using the Facade:

```php
SpanishID::isValidDni('1234foo');
SpanishID::isValidCif('1234foo');
SpanishID::isValidNie('1234foo');
SpanishID::isValidNNSS('1234foo');
```

You can also use these as validation rules:

```php
$rules = [
    'dni_field' => 'dni',
    'cif_field' => 'cif',
    'nie_field' => 'nie',
    'nif_field' => 'nif',
    'nnss_field' => 'nnss',
];
```


## Thanks

- The original laravel package by mpijierro 
[https://github.com/marcmascort/identity](https://github.com/marcmascort/identity)

- The original code for NIF, CIF AND NIE is in next link:  
[http://www.michublog.com/informatica/8-funciones-para-la-validacion-de-formularios-con-expresiones-regulares](http://www.michublog.com/informatica/8-funciones-para-la-validacion-de-formularios-con-expresiones-regulares)

- Thanks to original code for the validation of the NNSS of:    
[http://intervia.com/doc/validar-numeros-de-la-seguridad-social/](http://intervia.com)  
