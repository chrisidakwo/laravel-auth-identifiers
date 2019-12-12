# Laravel Authentication Identifiers
Laravel Auth Identifier is a small library that allows you to use custom authentication identifiers such as: `email, password, phone_number or pin` and a password to authenticate users in your application. It also allows you to implement a custom password validator using a class or closure function.


Installation
------------
```bash
composer require chrisidakwo/laravel-auth-identifiers
```

Setup
------------
**Step 1:**  You can either add the ``ChrisIdakwo\Auth\Providers\CustomAuthServiceProvider::class`` to the providers array in the``config/app.php`` file. Ensure it's below ``App\Providers\AuthServiceProvider::class`` to avoid Laravel's default authentication overriding the library's implementation.

Or you can use the 
``ChrisIdakwo\Auth\Providers\BootCustomAuthProvider`` trait in the ``App\Providers\AuthServiceProvider`` class like below:

```php
<?php
namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use ChrisIdakwo\Auth\Providers\BootCustomAuthProvider;

class AuthServiceProvider extends ServiceProvider {
    use BootCustomAuthProvider;

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        $this->registerPolicies();

        $this->bootCustomAuthProvider();
    }
}
```

**Step 2:** Publish config file: ``php artisan vendor:publish ChrisIdakwo\Auth\Providers\CustomAuthServiceProvider --tag=config``

**Step 3:** Update the ``User`` model to use the ``ChrisIdakwo\Auth\Traits\CustomAuthUser`` trait.

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


**Step 4:** Update the providers driver for users in the ``config/auth.php`` file like below:
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

