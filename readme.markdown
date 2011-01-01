h1 Install:

$ cake schema create seo -plugin seo

h1 SEO Redirect Errors
create file @@@app/app_error.php@@@ with the following:

{{{
<?php
App::import('Lib','Seo.SeoUtil');
class AppError extends SeoAppError {
}
?>
}}}