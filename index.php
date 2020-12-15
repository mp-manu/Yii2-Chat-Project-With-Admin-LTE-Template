<?php

$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'],'/')) : '/';

if ($url == '/')
{
    require_once __DIR__.'/Models/index_model.php';
    require_once __DIR__.'/Controllers/index_controller.php';
    require_once __DIR__.'/Views/index_view.php';
    $indexModel = New IndexModel();
    $indexController = New IndexController($indexModel);
    $indexView = New IndexView($indexController, $indexModel);
    print $indexView->index();
}else{
    $requestedController = $url[0];
    $requestedAction = isset($url[1])? $url[1] :'';
    $requestedParams = array_slice($url, 2);

    $ctrlPath = __DIR__.'/Controllers/'.$requestedController.'_controller.php';

    if (file_exists($ctrlPath))
    {

        require_once __DIR__.'/Models/'.$requestedController.'_model.php';
        require_once __DIR__.'/Controllers/'.$requestedController.'_controller.php';
        require_once __DIR__.'/Views/'.$requestedController.'_view.php';

        $modelName      = ucfirst($requestedController).'Model';
        $controllerName = ucfirst($requestedController).'Controller';
        $viewName       = ucfirst($requestedController).'View';

        $controllerObj  = new $controllerName( new $modelName );
        $viewObj        = new $viewName( $controllerObj, new $modelName );
        if ($requestedAction != '')
        {
            print $viewObj->$requestedAction($requestedParams);
        }

    }else{
        header('HTTP/1.1 404 Not Found');
        die('404 - The file - '.$ctrlPath.' - not found');
    }
}