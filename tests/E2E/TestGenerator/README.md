PrestaTest
=============
## Summary
PrestaTest is a web application, designed to facilitate lauching E2E automated tests for PrestaShop.
## Requirements
Under the application's folder (PrestaShop/tests/E2E/TestGenerator) run:
```
composer install
```
## How to start
Open the application's folder (TestGenerator) situated under PrestaShop/tests/E2E with the Terminal and run the following command:
```
php bin/console server:run
```
> Note:
> You have to run the Selenium Server in order to be able to launch any test,
> go under PrestaShop/tests/E2E and run :

```
npm run start-selenium
```