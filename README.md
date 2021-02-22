# Contact Us Form Package

## An elegant way to scan all text of blade files and send to database them.

### <p style="color: blue;">composer require teampro/language-translation-scanner</p>

### You should place it in config/app.php ===> 'providers' => 
### [ ...
###           TeamPro\TranslateScanner\TranslateScannerServiceProvider::class,
### ]

### For finding texts use --- composer require nette/finder ---
### Do  ---  php artisan migrate ---  and   scan it with    --- php artisan scan:translation ---  in cmd.
## All formats of text must be --- t("your text here") --- in .blade.php files. For example: <p>t("your any texts here")</p> it may contain any tags which have t("your text here").
