<?php

use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

    // validator
    $container['validator'] = function () {
        return new \Awurth\SlimValidation\Validator();
    };

    // csrf
    $container['csrf'] = function ($c) {
        //return new \Slim\Csrf\Guard;
        $guard = new \Slim\Csrf\Guard();
        $guard->setFailureCallable(function ($request, $response, $next) {
            $request = $request->withAttribute("csrf_status", false);
            return $next($request, $response);
        });
        return $guard;
    };

    // view renderer
    $container['renderer'] = function ($c) {
        $settings = $c->get('settings')['renderer'];
        return new \Slim\Views\PhpRenderer($settings['template_path']);
    };

    // view
    $container['view'] = function ($c) {
        $settings = $c->get('settings');
        $view = new Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);

        // Add extensions
        $view->addExtension(new \Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
        $view->addExtension(new \Twig_Extension_Debug());
        $view->addExtension(new \Awurth\SlimValidation\ValidatorExtension($c['validator']));
        $view->addExtension(new \App\Extension\TwigExtension\CsrfExtension($c->get('csrf')));
        return $view;
    };

    // monolog
    $container['logger'] = function ($c) {
        $settings = $c->get('settings')['logger'];
        $logger = new \Monolog\Logger($settings['name']);
        $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
        $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
        return $logger;
    };
};
