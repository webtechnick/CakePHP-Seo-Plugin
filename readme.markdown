# Search Engine Optimization CakePHP Plugin
* Author: Nick Baker
* Version: 3.0
* License: MIT
* Website: http://www.webtechnick.com

## Install

Clone the repository into your `app/plugins/seo` directory:

	$ git clone git://github.com/webtechnick/CakePHP-Seo-Plugin.git app/plugins/seo

Run the schema into your database:

	$ cake schema create seo -plugin seo
	
## Setup

Create the file `app/config/seo.php` with the following configurations like so:

	<?php
	$config = array(
		'Seo' => array(
			'approverEmail' => 'nick@example.com',
			'replyEmail' => 'noreply@example.com',
			'parentDomain' => 'http://www.example.com'
		)
	);
	?>

## SEO Redirect Quick Start
create file `app/app_error.php` with the following:

	<?php
		App::import('Lib','Seo.SeoUtil');
		SeoUtil::loadSeoError();
		class AppError extends SeoAppError {
		}
	?>
	
### Add Redirects	
`http://www.example.com/admin/seo/seo_redirects/`

## SEO Meta Tags Quick Start

Include the `Seo.Seo` Helper to your `app_controller.php`:

    var $helpers = array('Seo.Seo');

Alter your layout to include the Seo Meta Tags in the head of your layout

		<head>
			<!-- other head items -->
			<?php echo $this->Seo->metaTags(); ?>
    </head>

### Add Meta Tags

`http://www.example.com/admin/seo/seo_meta_tags`


## SEO Titles Quick Start

Include the `Seo.Seo` Helper to your `app_controller.php`:

    var $helpers = array('Seo.Seo');

Alter your layout to include the Seo Meta Tags in the head of your layout

		<head>
   		<!-- other head items -->
   		<title><?php echo $this->Seo->title(); ?></title>
   	</head>

### Add Meta Tags

`http://www.example.com/admin/seo/seo_titles`


# Wiki Links
  * https://github.com/webtechnick/CakePHP-Seo-Plugin/wiki/Seo-Redirects
  * https://github.com/webtechnick/CakePHP-Seo-Plugin/wiki/Seo-Meta-Tags