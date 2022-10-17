Make sure that minimum-stability is dev.
```
git clone https://github.com/oxid-support/t110285

composer config repositories.oxid-support/command path t110285/oxs/command
composer require oxid-support/command

./vendor/bin/oe-console oe:module:activate oxscommand
```
