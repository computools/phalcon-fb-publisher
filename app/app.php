<?php
/**
 * Local variables
 * @var \Phalcon\Mvc\Micro $app
 */

$app->router->setUriSource(Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI);

/**
 * Add your routes here
 */
$app->get('/', new \App\Action\DefaultAction($app));
$app->post('/api/auth', new \App\Action\Auth\RegisterAction($app, new \App\Validator\AuthValidator()));
$app->post('/api/auth/login', new \App\Action\Auth\LoginAction($app, new \App\Validator\AuthValidator()));
$app->get('/api/post', new \App\Action\Post\ListPostAction($app));
$app->get('/api/post/{postId}', new \App\Action\Post\GetPostAction($app));
$app->post('/api/post', new \App\Action\Post\CreatePostAction($app, new \App\Validator\PostValidator()));
$app->put('/api/post/{postId}', new \App\Action\Post\UpdatePostAction($app, new \App\Validator\PostValidator()));
$app->delete('/api/post/{postId}', new \App\Action\Post\DeletePostAction($app));
$app->put('/api/post/{postId}/theme/{themeId}', new \App\Action\Post\AddThemeToPostAction($app));
$app->delete('/api/post/{postId}/theme/{themeId}', new \App\Action\Post\RemoveThemeFromPostAction($app));
$app->get('/api/theme', new \App\Action\Theme\ListThemesAction($app));
$app->post('/api/theme', new \App\Action\Theme\CreateThemeAction($app, new \App\Validator\ThemeValidator()));
$app->put('/api/theme/{themeId}', new \App\Action\Theme\UpdateThemeAction($app, new \App\Validator\ThemeValidator()));
$app->delete('/api/theme/{themeId}', new \App\Action\Theme\DeleteThemeAction($app));
$app->get('/api/channel/link', new \App\Action\Channel\GetChannelLinkAction($app));
$app->post('/api/channel', new \App\Action\Channel\CreateChannelAction($app));
$app->get('/api/channel', new \App\Action\Channel\ChannelListAction($app));
$app->delete('/api/channel/{channelId}', new \App\Action\Channel\DeleteChannelAtion($app));
$app->post('/api/post/{postId}/publication/{channelId}', new \App\Action\Publication\CreatePublicationAction($app));

$app->get('/api', function() {
	$this->response->setJsonContent([]);
	$this->response->send();
});

/**
 * Not found handler
 */
$app->notFound(function () {
    throw new \App\Exception\NotFoundApiException();
});
