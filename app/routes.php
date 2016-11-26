<?php

// Page d'accueil
$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html.twig');
});

// Administration back-office
$app->get('/admin', function () use ($app){
    return $app['twig']->render('admin.html.twig');
});

// 404 Error
$app->error(function (\Exception $e, $code) use ($app){
    switch($code){
        case 404:
            return $app['twig']->render('404.html.twig');
            break;
        default:
            $message = 'We are sorry.';
    }
});
