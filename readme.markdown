# Search Engine Optimization CakePHP Plugin
* Author: Nick Baker, Alan Blount
* Version: 4.5.0
* License: MIT
* Website: <http://www.webtechnick.com>

## Features

Complete tool for all your CakePHP Search Engine Optimization needs

* Easy yet powerful 301 redirect tools only loaded when a 404 would otherwise occur
* Highly configurable and customizable Meta Tags for any incoming URI
* Title tag overwrites based on URI
* Scrapper Banning administration, complete with honeyPot baiting for scrappers to ban themselves.

## Changelog
* 4.5.0 New Seo Canonical gives an SEO the ability to Canonical link any url much like the Seo Title tool
* 4.4.0 New Seo Status Codes gives an SEO the ability to 410, or any other error code based on URI
* 4.3.0 SeoHelper::metaTags now takes in an associative array of default meta tags to use (seo tags have priority)
* 4.2.x Bug fixes and updates, update config file
* 4.0.0 Blacklist added
* 1.0.0 Initial Release

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
			'parentDomain' => 'http://www.example.com',
			'triggerCount' => 2,
			'timeBetweenTriggers' => 60 * 60 * 24, //seconds
			'aggressive' => true, //if false, log affenders for later review instead of autobanning
			'honeyPot' => array('admin' => false, 'plugin' => 'seo', 'controller' => 'seo_blacklists', 'action' => 'honeypot'),
			'log' => true,
			'cacheEngine' => false, // optionally cache things to save on DB requests - eg: 'default'
		)
	);
	?>

## SEO Redirect/Status Code Quick Start
create file `app/app_error.php` with the following:

	<?php
		App::import('Lib','Seo.SeoUtil');
		SeoUtil::loadSeoError();
		class AppError extends SeoAppError {
		}
	?>
	
### Add Redirects	
`http://www.example.com/admin/seo/seo_redirects/`

### Add Redirects	
`http://www.example.com/admin/seo/seo_status_codes/`


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

Alter your layout to include the Seo Title in the head of your layout

	<head>
		<!-- other head items -->
		<?php echo $this->Seo->title($title_for_layout); ?>
	</head>

### Add Title Tags

`http://www.example.com/admin/seo/seo_titles`


## SEO Canonical Quick Start

Include the `Seo.Seo` Helper to your `app_controller.php`:

  var $helpers = array('Seo.Seo');

Alter your layout to include the Seo Canonical in the head of your layout

	<head>
		<!-- other head items -->
		<?php echo $this->Seo->canonical(); ?>
	</head>

### Add Canonical Links

`http://www.example.com/admin/seo/seo_canonicals`

## SEO BlackList Quick Start

Include The `Seo.BlackList` Component in your `app_controller.php`:

	var $components = array('Seo.BlackList');

Start adding honeypot links in and around your application to bait malicious content grabbers

	<?php echo $this->Seo->honeyPot(); ?>

Update your `robots.txt` to exclude `/seo/` from being spidered.  All legitimate spiders will ignore the honeyPot

	User-agent: *
	Disallow: /seo/

### Add/Manage Banned IPs

`http://www.example.com/admin/seo/seo_blacklists`


# Wiki Links
  * <https://github.com/webtechnick/CakePHP-Seo-Plugin/wiki/Seo-Redirects>
  * <https://github.com/webtechnick/CakePHP-Seo-Plugin/wiki/Seo-Meta-Tags>
  * <https://github.com/webtechnick/CakePHP-Seo-Plugin/wiki/Seo-Title-Tags>
