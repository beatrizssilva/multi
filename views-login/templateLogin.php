<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=0" />
        
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" type="text/css" />
        
      
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script> 
        <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script> 
        
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/style-login.css" />
        
        <title>Lar Alimentos</title>
    </head>
<body>
    <header>
<!--        <h1>LAR ALIMENTOS - Login</h1>-->
    </header>

<?php $this->loadViewinTemplateLogin($viewName, $viewData); ?>
    <footer>
        
    </footer>
    <script type="text/javascript">
        var BASE_URL = '<?php echo BASE_URL; ?>';
    </script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-ui.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/script.js" type="text/javascript"></script>
    
</body>
</html>
