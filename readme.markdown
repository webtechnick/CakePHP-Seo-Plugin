# Search Engine Optimization CakePHP Plugin
* Author: Nick Baker
* Version: 1.0
* License: MIT

## Install

Run the schema into your database:
	$ cake schema create seo -plugin seo

Or execute the *app/plugins/seo/config/sql/seo_redirect.sql* into your database:

## SEO Redirect Errors
create file *app/app_error.php* with the following:

	<?php
		App::import('Lib','Seo.SeoUtil');
		class AppError extends SeoAppError {
		}
	?>