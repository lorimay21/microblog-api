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
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 * Cache: Routes are cached to improve performance, check the RoutingMiddleware
 * constructor in your `src/Application.php` file to change this behavior.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    // Register scoped middleware for in scopes.
    $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true
    ]));

    /**
     * Apply a middleware to the current route scope.
     * Requires middleware to be registered via `Application::routes()` with `registerMiddleware()`
     */
    $routes->applyMiddleware('csrf');

    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *
     * ```
     * $routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);
     * $routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);
     * ```
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});

/**
 * API routes
 */
Router::scope('/api', function (RouteBuilder $routes) {
    /**
     * User API routes
     */
    $routes->post('/users', ['controller' => 'Users', 'action' => 'register']); // Create users API
    $routes->get('/users', ['controller' => 'Users', 'action' => 'index']); // Fetch user information API
    $routes->put('/users', ['controller' => 'Users', 'action' => 'edit']); // Update user information API
    $routes->delete('/users', ['controller' => 'Users', 'action' => 'terminate']); // Terminate user API
    $routes->post('/login', ['controller' => 'Users', 'action' => 'login']); // Login user API
    $routes->get('/logout', ['controller' => 'Users', 'action' => 'logout']); // Logout user API
    $routes->post('/follow', ['controller' => 'Users', 'action' => 'follow']); // Follow user API
    $routes->delete('/unfollow', ['controller' => 'Users', 'action' => 'unfollow']); // Unfollow user API

    /**
     * Post API routes
     */
    $routes->post('/posts', ['controller' => 'Posts', 'action' => 'create']); // Create post API
    $routes->get('/posts', ['controller' => 'Posts', 'action' => 'index']); // Display all posts API
    $routes->put('/posts', ['controller' => 'Posts', 'action' => 'edit']); // Update post API
    $routes->delete('/posts', ['controller' => 'Posts', 'action' => 'delete']); // Delete post API
    $routes->get('/view', ['controller' => 'Posts', 'action' => 'view']); // View post API
    $routes->post('/like', ['controller' => 'Posts', 'action' => 'like']); // Like post API
    $routes->delete('/unlike', ['controller' => 'Posts', 'action' => 'unlike']); // Unlike post API
    $routes->post('/repost', ['controller' => 'Posts', 'action' => 'repost']); // Repost post API
    $routes->delete('/unrepost', ['controller' => 'Posts', 'action' => 'unrepost']); // Unrepost post API

    /**
     * Comment API routes
     */
    $routes->post('/comments', ['controller' => 'Comments', 'action' => 'create']); // Add comment API
    $routes->put('/comments', ['controller' => 'Comments', 'action' => 'edit']); // Edit comment API
    $routes->delete('/comments', ['controller' => 'Comments', 'action' => 'delete']); // Delete comment API
});
