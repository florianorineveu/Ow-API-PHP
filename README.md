# Ow-API (Overwatch API) PHP Wrapper

![MIT License](https://img.shields.io/badge/license-MIT-007EC7.svg?style=flat-square)
![Current Version](https://img.shields.io/badge/version-1.0.3-green.svg)

## Overview

This repository contains an unofficial PHP wrapper for the Ow-API.

API resources and response examples are in the [Official Documentation](https://ow-api.com/).

## Table of contents

- [Compatibility](#compatibility)
- [Installation](#installation)
- [How to use](#how-to-use)
- [Contribute](#contribute)

## Compatibility

This library requires **PHP v7.1** or higher.

## Installation

Use the below code to install the wrapper:

`composer require fnev-eu/ow-api-php`

## How to use

### Example

```php
<?php

require 'vendor/autoload.php';

use \OwAPI\Client;

$client = new Client(); 

// Get profile data for player Ori#21337 (it's me!), 
$response = $client->profile(Client::PLATFORMS['PC'], Client::REGIONS['EU'], 'Ori#21337');

// Read the response
if ($response->isSuccess()) {
    echo $response->getBody()['name'];
}

// Other available methods:
// - ALL profile data, heavy endpoint
$completeStats = $client->completeStats(Client::PLATFORMS['PC'], Client::REGIONS['EU'], 'Ori#21337');

// - Get profile data for specific heroes:
$heroesStats = $client->heroes(
    Client::PLATFORMS['PC'],
    Client::REGIONS['EU'],
    'Ori#21337',
    ['brigitte', 'mercy', 'ana']
);
```

The `profile`, `completeStats` and `heroes` method will return a `Response` with the following methods:
- `isSuccess`: returns a boolean indicating if the API call was successful
- `getStatus`: HTTP status code
- `getBody`: PHP associative array from the JSON response
- `getRequest` and `getRawResponse` to help you for debug 

## Contribute

Feel free to ask anything and contribute:
- Fork the project
- Create a new branch
- Implement your idea or fix
- Commit, push and open a pull request!
