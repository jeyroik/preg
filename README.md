# preg
Simple preg replace wrapper

# Install

composer require jeyroik/preg:1.0

# Usage

```php
use jeyroik\tools\components\Preg;

$s = 'Hello, @user.name! You hit this page @user.stat.hits times!';
$preg = new Preg();
echo $preg->apply([
  'user' => [
    'name' => 'JeyRoik',
    'stat' => [
      'hits' => 10
    ]
  ]
])->to($s);
```

Result will be:

```php
Hello, JeyRoik! You hit this page 10 times!
```
