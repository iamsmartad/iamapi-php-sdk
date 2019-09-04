Its just a protype for now. Will add basic usage with authentication later.
Not on packagist for now. How to use in iamdevelopment/iamstudent:

*  cd iamnetwork/
*  mkdir lib
*  cd lib
*  git clone https://gitlab.com/iamdevelopment/iamapi-php-sdk.git
*  cd iamapi-php-sdk
*  composer install
*  open iamnetwork/composer.json
*  add `"autoload": {
    "psr-4": {
      "Iamstudent\\": "src/",
      "Iamstudent\\Composer\\": "src/Iamstudent/Composer/",
      "Iamdevelopment\\Iamapi\\SDK\\": "lib/iamapi-php-sdk/src/"
    }
  },` so the library gets autoloaded
