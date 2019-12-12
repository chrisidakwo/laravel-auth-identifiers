# Laravel Authentication Identifiers
Laravel Auth Identifier is a small library that allows you to use custom authentication identifiers such as: `email, password, phone_number or pin` and a password to authenticate users in your application. It also allows you to implement a custom password validator using a class or closure function.


Installation
------------
```bash
composer require chrisidakwo/laravel-auth-identifiers
```

After installation, add the service provider to the providers array in the``config/app.php`` file. Ensure it's below ``App\Providers\AuthServiceProvider::class`` to avoid Laravel's default ```AuthServiceProvider``` overriding this library's implementation.

```php
ChrisIdakwo\Auth\Providers\CustomAuthServiceProvider::class
```

**Laravel 5.5** uses package auto-discovery, so doesn't require you to manually add the ServiceProvider.

#### Config
Publish config file only when you need to use a custom password validator

``php artisan vendor:publish ChrisIdakwo\Auth\Providers\CustomAuthServiceProvider --tag=config``

#### User Model
Update the ``User`` model to use the ``ChrisIdakwo\Auth\Traits\CustomAuthUser`` trait.

```php
<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use ChrisIdakwo\Auth\CustomAuthUser;

class User extends Authenticatable {
    use Notifiable, CustomAuthUser;

    /**
     * Get the name of the unique identifier for the user.
     * 
     * You can list as many items as possible in the array, or just one item.
     *
     * @return array
     */
    public function getAuthIdentifiersName(): array {
        return ['email', 'username', 'phone_number', 'pin'];
    }
}
```

With this you can authenticate a user against either of an email, username, phone number, or a pin code.

#### Auth Driver
 Update the providers driver for users in the ``config/auth.php`` file like below:
```php
<?php

return [

    // ...

    'providers' => [
        'users' => [
            'driver' => 'custom-auth',
            'model'  => App\Models\Auth\User::class,
        ],
    ],

    // ...
];
```

Usage
------------
```php
<?php

use Illuminate\Support\Facades\Auth;

$data = ['identifier' => 'johndoe@desevens.com', 'password' => 'foobar'];

if (Auth::attempt($data)) {
    // Continue with whatever you want to do
}
```

TODO
------------
- Write Test Cases

Note
------------
Still in active development. But can be used as is.

