Fluidads Bundle for Communication With Fluidads API
====================================================

Currently supports authentication and assets API paths only



Installation
==============
In your project, update the composer.json file to include the following in the "require" block:

"fluidads/fluidads-api-bundle" : "dev-master"

Add the following to the composer.json

"repositories" : [{
    "type" : "vcs",
    "url" : "https://github.com/nealhowarth79/fabundle.git"
}]

Then run 
```console
composer install
```

Usage
=======
Authenticate with the Fluidads API by sending a valid email and password:

For example:

```php
use Fluidads\ApiBundle\ApiConnection;

$connection = new ApiConnection;
$response = $connection->authorise("fluidads@test.com", "password");
```

Save the apiToken, from the response, for further API calls.
