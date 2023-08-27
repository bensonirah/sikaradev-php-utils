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