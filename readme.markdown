# Install:

	$ cake schema create seo -plugin seo

# SEO Redirect Errors
create file @@@ app/app_error.php @@@ with the following:

	{{{
	<?php
	App::import('Lib','Seo.SeoUtil');
	class AppError extends SeoAppError {
	}
	?>
	}}}