<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
 
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	// Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
    //viet lại link cho phần đăng nhập
    Router::connect('/users/login' ,array('controller' => 'users', 'action' => 'login' ));


    Router::connect('/books/search/*', ['controller' => 'books', 'action' => 'getSearch', '[method]' => 'GET']);
    Router::connect('/books/search/*', ['controller' => 'books', 'action' => 'postSearch', '[method]' => 'POST']);
    
    // Router::connect('/sach-moi', array('controller' => 'books', 'action' =>'view_cart'));
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
    Router::connect('/',array('controller' => 'books', 'action' => 'index'));
    Router::connect('/sach-moi',array('controller' => 'books', 'action' => 'latest_books'));
    Router::connect('/tac-gia' ,array('controller' => 'writers', 'action' => 'index' ));
    //viet lai link phan gio hang chi tiet
    Router::connect('/gio-hang', array('controller' => 'books', 'action' => 'view_cart'));
    //router thân thiện phần category

    Router::connect('/danh-muc/*' , array('controller' => 'categories', 'action'=>'view'));
    //router thân thien tac gia
    Router::connect('/tac-gia/*', array('controller' => 'writers', 'action'=> 'view'));

    Router::connect('/add', ['controller' => 'comments', 'action' => 'add']);

    //router thân thiện-phần book
    Router::connect('/:book_title' ,array('controller' => 'books', 'action' => 'view' ), array('pass'=>array('book_title')));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	 CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	 require CAKE . 'Config' . DS . 'routes.php';
