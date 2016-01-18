# Algolia Test App Store app #

### Setup ###

* Clone this repository
* Fill your Algolia credentials into `app/config.inc.php` file
* Run the app

### Implemented endpoints ###

* `GET /` => Render an HTML page displaying an auto-completion menu searching in an Algolia `apps` index.
* `POST /api/1/apps` => Add an app (as a JSON object) to the Algolia `apps` index and return its `id`
* `DELETE /api/1/apps/:id` => Delete an app from the Algolia index

### Requirements ###

* Set up `apps` index in Algolia