<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Cloud Foundry demo</title>
  <meta name="description" content="Cloud Foundry demo">
  <link rel="stylesheet" href="styles.css">
</head>

<body>
  
  <div id="img">
      <img src="http://cloudfoundry.org/images/logo_org.png"/>
  </div>

	<div id="content-container">
		<div id="content2">
		<h2>VCAP_SERVICES</h2>
		<hr />
		<pre>
$services = getenv('VCAP_SERVICES');
$services_json = json_decode($services, true);
print_r ($services_json);
		<hr />
		<?php
			$services = getenv('VCAP_SERVICES');
			$services_json = json_decode($services, true);
			echo '<pre>';
			print_r ($services_json);
			echo '</pre>';
		?>
		</div>
	</div>

</body>
</html>