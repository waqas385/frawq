<!DOCTYLE html>
<html>
    <head>
        <meta charset="utf-8">
        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>frawq : framework waqas</title>
        <!-- Bootstrap -->
        <link href="<?php echo \App::$base_url ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo \App::$base_url ?>assets/css/style.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <!-- Inner Content of Dynamic Page -->
        <div class="container">
            <?php echo $content ?>
        </div>
        
    </body>
    <!-- Include JS here -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo \App::$base_url ?>assets/js/jquery_1.11.3_jquery.min.js"></script>
    <script src="<?php echo \App::$base_url ?>assets/bootstrap/js/bootstrap.min.js"></script>

</html>