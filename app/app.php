<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
use Silex\Provider\SwiftmailerServiceProvider;

// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Register service providers.
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.messages' => array(),
));
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'secured' => array(
            'pattern' => '^/',
            'anonymous' => true,
            'logout' => array('logout_path' => '/admin/logout', 'invalidate_session' => true),
            'form' => array('login_path' => '/login', 
                'check_path' => '/login_check',
                'default_target_path' => '/admin',
                'always_use_default_target_path' => true,
                ),

            'users' => $app->share(function () use ($app) {
                return new Push\DAO\UserDAO($app['db']);
            }),
        ),
    ),
    'security.role_hierarchy' => array(
        'ROLE_ADMIN' => array('ROLE_USER'),
    ),
    'security.access_rules' => array(
        array('^/admin', 'ROLE_ADMIN', 'https'),
    )
));
$app->register(new SwiftmailerServiceProvider());
$app['swiftmailer.options'] = array(
    'host'       => 'auth.smtp.1and1.fr',
    'port'       => 465,
    'username'   => 'communication@pushapp.fr',
    'password'   => 'Iesa2016&',
    'encryption' => 'ssl',
    'auth_mode'  => 'login'
);

//Register services.
$app['dao.user'] = $app->share(function ($app) {
    return new Push\DAO\UserDAO($app['db']);
});
$app['dao.beta'] = $app->share(function ($app) {
    return new Push\DAO\BetaDAO($app['db']);
});
