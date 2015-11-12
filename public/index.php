<?php
ini_set('auto_detect_line_endings', true);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(-1);

$loader = require_once __DIR__ . '/../vendor/autoload.php';
$loader->register();

require_once __DIR__.'/bootstrap.php';


use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

$collection = new RouteCollection();

$collection->add(
    'all_accounts',
    new Route(
        '/accounts',
        array(
            'controller' => 'OrmTalk\Controller\AccountsController',
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

$context = new RequestContext();
$request = Request::createFromGlobals();
$context->fromRequest($request);

$matcher = new UrlMatcher($collection, $context);

$response = new JsonResponse();

$attributes = $matcher->match($request->getPathInfo());

$controller = new $attributes['controller'];

$response->setData(
    call_user_func_array(
        [$controller, $attributes['action']],
        array_slice($attributes, 2, count($attributes) - 3)
    )
);

$response->send();
