<!doctype html>
<html>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <?php echo link_tag('css/datatables.css'); ?>
    <?php echo link_tag('css/style.css'); ?>
            
    <title><?php echo $title ?></title>
  </head>
<body class="flex-row align-items-center">
    
   <?php echo $this->renderSection('content') ?>
    
    <?php echo script_tag('js/jquery-1.9.1.js'); ?>
    
    <?php echo script_tag('js/jquery.validate.min.js'); ?>
    <?php echo script_tag('js/datatables.min.js'); ?>
    
    <?php echo script_tag('js/script.js'); ?>
    
    
</body>
</html> 
