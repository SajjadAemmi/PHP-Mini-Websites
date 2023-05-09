<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <title>Yas</title>
	
	<link rel="icon" href="images/icon.ico">
	
    <!-- Bootstrap core CSS -->
    <link href="<?php echo BASE_URI; ?>css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo BASE_URI; ?>css/custom.css" rel="stylesheet">
	  <?php
      if(!isset($title))
      {
        $title = SITE_TITLE;
      }
     ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="<?php echo BASE_URI; ?>js/bootstrap.js"></script>
		<script src="<?php echo BASE_URI; ?>js/ckeditor/ckeditor.js"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>

  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="index.php"><img src="images/yas.png" style="height:25px;"></a>
          <a class="navbar-brand" href="index.php">YAS</a>
           
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <?php if(!isLoggedIn()) : ?>
            <li><a href="register.php"><span class="glyphicon glyphicon-edit"></span> Create An Account</a></li>
            <?php else: ?>
            <li><a href="create.php"><span class="glyphicon glyphicon-pencil"></span> Create Topic</a></li>
            <?php endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="row">
		<div class="col-md-8">
			<div class="main-col">
				<div class="block">
					<h1 class="pull-left"><?php echo $title; ?><h1>
					<h4 class="pull-right">a PHP forum engine<h4>
					<div class="clearfix"></div>
					<hr>
          <?php displayMessage(); ?>