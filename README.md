# Sikaradev php utils
 A php helpers functions for usage in daily dev

**`filter` function**

A function to filter a collection of any data type

**Usage:**

```php
<?php

$filteredItems = Collection::of(['index.php', 'data/country.json'])
->filter((int $k,string $v)=>$v==1)
```

**`map` function**

Convert the data into other type of data

**Usage:**

```php
<?php
$result = Collection::of(['index.php', 'data/country.json'])
    ->filter(fn(int $k, string $path) => $k == 0)
    ->map(fn(string $v) => strtoupper($v))
    ->get();
```