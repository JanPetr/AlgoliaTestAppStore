# Algolia Test App Store app #

Demo: <http://algolia-test.naseobchody.cz/>

### Setup ###

* Clone this repository
* Install composer dependencies with `composer install`
* Fill your Algolia credentials into `app/config.inc.php` file
* Run the app

### Implemented endpoints ###

* `GET /` => Render an HTML page displaying an auto-completion menu searching in an Algolia `apps` index.
* `POST /api/1/apps` => Add an app (as a JSON object) to the Algolia `apps` index and return its `id`
* `DELETE /api/1/apps/:id` => Delete an app from the Algolia index

### Basic information ###

* Framework itself is located in `MVC` directory
* App itself (Controllers, Template, Models) is located `app` directory
* Tests can be found in `tests` directory and are divided into `MVC` nad `app` tests
	* Test can be run from within `tests` directory by command `../vendor/bin/tester . -c test_php.ini`
	* App tests needs filled Algolia credentials in `app/config.inc.php` file
	
**Enjoy the Algolia Test App Store :)**