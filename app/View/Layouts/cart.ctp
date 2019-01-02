
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>
      Welcome to FlatShop
    </title>
    <!-- <link href="css/bootstrap.css" rel="stylesheet"> -->
    <?php echo $this->Html->css('bootstrap') ?>
    <?php echo $this->Html->css('style1') ?>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,700,500italic,100italic,100' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen"/>
    <!-- <link href="css/style.css" rel="stylesheet" type="text/css"> -->
  </head>
  <body>
      <?php echo $this->fetch('content'); ?>
  </body>
</html>