<?php
use Symfony\Component\HttpFoundation\Request;
use Push\Domain\User;
use Push\Domain\Beta;
use Push\Form\Type\BetaType;
use Push\Form\Type\UserType;

// Page d'accueil
$app->get('/', function (Request $request) use ($app) {
    $beta = new Beta();
    $betaForm = $app['form.factory']->create(new BetaType(), $beta);
    $betaForm->handleRequest($request);
    if($betaForm->isSubmitted() && $betaForm->isValid() ){
        $app['dao.beta']->save($beta);
        $app['session']->getFlashBag()->add('success', 'Bravo !');
    }
    $betaFormView = $betaForm->createView();
    return $app['twig']->render('index.html.twig', array('betaForm' => $betaFormView));
});

// Administration back-office
$app->get('/admin', function () use ($app){
    $betas = $app['dao.beta']->findAll();
    $users = $app['dao.user']->findAll();
    return $app['twig']->render('admin.html.twig', array(
        'betas' => $betas,
        'users' => $users
    ));
})->bind('admin');

//Delete beta-mail
$app->get('/admin/beta/{id}/delete', function ($id, Request $request) use ($app){
    $app['dao.beta']->delete($id);
    $app['session']->getFlashBag()->add('success', 'La participation à la bêta a été correctement supprimée.');
    return $app->redirect($app['url_generator'])->generate('admin');
})->bind('admin_beta_delete');

//Editing an user
$app->match('/admin/profil/{id}/editer', function($id , Request $request) use ($app){
    $user = $app['dao.user']->find($id);
    $userForm = $app['form.factory']->create(new UserType(), $user);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
        $plainPassword = $user->getPassword();
        $encoder = $app['security.encoder_factory']->getEncoder($user);
        $password = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($password);
        $app['dao.user']->save($user);
        $app['session']->getFlashBag()->add('success', 'The user was succesfully updated.');
    }
    return $app['twig']->render('user_form.html.twig', array(
        'userForm' => $userForm->createView()));
    })->bind('admin_user_edit');

//Login
$app->get('/login', function(Request $request) use ($app) {
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
})->bind('login');

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
