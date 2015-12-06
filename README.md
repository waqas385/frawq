AUTHER INFORMATION
Name: Waqas Ahmed
Email: waqas385@gmail.com

I have added bootstrap css files already under assets folder. You just need to create template for your new project.

Installation:
- Create folder for new project and add path in vhosts.
- Placed downloaded code in newly created folder.
- Make sure to edit following file:
  "src\config\app.php" and update base_url variable with the server address you have added in vhosts
- Hit url in browser. If it says 'Welcome', then you have successfully configure frawq on your machine.

Directory Structure:
- src
  -config
    - app.php 
    // Assign complete base url of your new site to base_url. You can access the $base_url variable any where in views
    // e.g <?php echo \App::$base_url ?>assets/js/some.js
    
    - database.php 
    // Add database information in this file
    
    - filters.php
    // Filters can be added here. Need to create a static function here, they called under routes.php under 'before' index
    // '/' => array('uses' => '\Controllers\IndexController@index', 'before' => 'isLoggedIn'),
    
    - languages.php 
    // for multilingual you can use this file. But currently its functionality is not implemented yet
    
    - routes.php
    // that is the heart of frawq. It contains pure logic of request manipulation. All you have to create a route and link to      // the controller that will entertain this request.
    // e.g '/' => array('uses' => '\Controllers\IndexController@index', 'before' => 'isLoggedIn')
    // '/' => is the URI
    // array contains the linked controller, also the filter if any applied
  
  - controllers 
    // this folder will contains all your controller.
    // Make sure you have extends your controller from \System\Controller
    // I have created a sample Controller under this, you can get basic information from it

  - Models
    // This folder will contain main business logic and table related stuff
    // I have created a sample Model under this, you can get basic information from it
    
  - System
    // This folder is the backbone of the framework. Don't change any thing under it, untill you understand the framework flow

  - Views
    // This folder will contain html templates to create layout of site.
    // I have created some views for testing purpose.

- assets
  - js
  - css
  - images
  // In order to add JS/CSS or any JS plugins use 'assets' folder.
