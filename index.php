<?
if (strpos($_SERVER["HTTP_HOST"],"body-fit.xyz")===false
    && strpos($_SERVER["HTTP_HOST"],"body-fit-xyz.u1314345.isp.regruhosting.ru")===false) { ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Hub8</title>
      <style>
      body, html {
  font: 14px "Open Sans", sans-serif;
  font-weight: normal;
  font-style: normal;
  line-height: 23px;
  color: #727272;
  width: 100%;
  height: 100%;
}

body{
  min-width: 280px;
  overflow-x: hidden;
}

h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
    font-family: "Roboto", sans-serif;
    font-weight: 500;
    color: #2a363f;
    letter-spacing: 0px;
}

p {
  text-align: left;
}

.well {
  font-weight: bold;
  margin-bottom: 0;
}

.section-wrapper {
  border: 15px solid #66bb6a;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  -webkit-transform: translate(-50%, -50%);
  position: absolute;
  max-width: 780px;
  padding: 3% 5%;
}

.section-container{
  position: relative;
  width: 100%;
  height: 100%;
  padding: 5% 15px;
}

.section-wrapper img {
  margin: 0 auto 0 auto;
  padding: 0 0 15px 0;
}

@media all and (max-width: 500px){

  .section-container{
    height: auto;
  }

  .section-wrapper{
    position: relative;
    top: 0;
    left: 0;
    transform: translate(-0%, -0%);
    -webkit-transform: translate(-0%, -0%);
  }

  h1,.h1{
    font-size: 27px;
    line-height: 30px;
  }

  h2,.h2{
    font-size: 25px;
    line-height: 28px;
  }

  h3,.h3{
    font-size: 19px;
    line-height: 21px;
  }

}
      </style>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Roboto:400,500,700" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

		<div class="section-container">
			<section class="section-wrapper">
				<a href="#" target="_blank"><img class="img-responsive" src="https://d3d5yivzt6e764.cloudfront.net/images/svg/HUB8-bg.svg" alt="HUB8"></a>
				<h1>WordPress hosting is activated</h1>
				<h2>You’re now accessing the website via its technical address.</h2>
				<p>How to link domain <a href="http://body-fit.xyz">body-fit.xyz</a> to WordPress: If the domain was registered at HUB8, then it’s configured already.</p>
				<p>The website will go online within 24 hours; If the domain was registered at another registrar, you need to specify nameservers as follows:</p>
				<div class="well">ns1.hosting.hub8.com<br />ns2.hosting.hub8.com</div>
			</section>
		</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>
<?
	die();
} ?><?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define( 'WP_USE_THEMES', true );

/** Loads the WordPress Environment and Template */
require __DIR__ . '/wp-blog-header.php';
