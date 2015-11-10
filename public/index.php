<?php
ini_set('auto_detect_line_endings', true);
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

$loader = require_once __DIR__ . '/../vendor/autoload.php';
$loader->register();

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

$collection = new RouteCollection();

$collection->add(
    'home',
    new Route(
        '/',
        array(
            'controller' => 'OrmTalk/Controller/HomeController',
            'action' => 'index'
        )
    )
);

$collection->add(
    'all_accounts',
    new Route(
        '/accounts',
        array(
            'controller' => 'OrmTalk\Controller\AccountController',
            'action' => 'all'
        )
    )
);

$collection->add(
    'each_account',
    new Route(
        '/accounts/{account_id}',
        array(
            'controller' => 'OrmTalk\Controller\AccountsController',
            'action' => 'get'
        )
    )
);

$collection->add(
    'all_users',
    new Route(
        '/users',
        array(
            'controller' => 'OrmTalk\Controller\UsersController',
            'action' => 'all'
        )
    )
);

$collection->add(
    'each_user',
    new Route(
        '/users/{user_id}',
        array(
            'controller' => 'OrmTalk\Controller\UsersController',
            'action' => 'get'
        )
    )
);

$context = new RequestContext();
$request = Request::createFromGlobals();
$context->fromRequest($request);

$matcher = new UrlMatcher($collection, $context);

$response = new JsonResponse();

$attributes = $matcher->match($request->getPathInfo());

var_dump($request->query->all()); die();

$response->setData(
    call_user_func_array(
        [$attributes['controller'], $attributes['action']],
        [array_slice($attributes, 2)]
    )
);

$response->send();
