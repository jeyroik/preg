# preg
Simple preg replace wrapper.

***Deprecated***. Moved to jeyroik/extas-foundation as [Replace](https://github.com/jeyroik/extas-foundation/blob/master/src/components/Replace.php).

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
