# Parseur

A parseur allow yout to extract data from any type of data source, either from
a text, document html or a website

## Features

- Text processor
- Url processor


### Usage:

**TextProcessor::class**
```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

$textProcessor = new \SikaradevPhpUtils\Parseur\TextProcessor();
$textContent = "...."; // Load your text content from a source for processing

$textProcessor->process($textConcent); // Process your text to parse it content line by line
```

**UrlProcessor::class**

This class collect and process data from any url of website and extract data from it.
Here is how you can use it:

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

$linkScanner = new MetaTagScanner(); // Here we use meta tag scanner for processing all meta tag from any 
// website url
$url = 'https://www.toyotamadagascar.com/toyota-rasseta'; // The url you want to scan to

try {
    $metaTag = (new UrlProcessor($linkScanner))
        ->scan($url);
    dump($metaTag);
} catch (GuzzleException $e) {
    dump($e->getMessage());
}
```


