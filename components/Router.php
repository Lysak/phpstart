<?php
class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath= ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }

    /**
     * Returns request string
     * @return string
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }


    public function run()
    {
        // Получить строку запроса
            $uri = $this->getURI();
//        echo $uri;

        // Проверить наличие такого запроса в routes.php
        foreach ($this->routes as $uriPattern => $path) {
//            echo "<br>$uriPattern -> $path";

            // Сравниваем $uriPattern (данные которые содержатся в роутах) и $uri (строка запроса)
            if (preg_match("~$uriPattern~", $uri)) {
//                echo '+';
//                echo '<br>Где ищем (запрос, который набрал пользователь): '.$uri;
//                echo '<br>Где ищем (совпадение из правил): '.$uriPattern;
//                echo '<br>Кто обрабатывает: '.$path;

                // Получаем внутренний путь из внешнего согласно правилу
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

//                echo '<br><br>Нужно сформировать: '.$internalRoute;


                // Определить котроллер, action и параметры

                // Определить какой контроллер
                // и action обрабатывают запрос

                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);
//                echo $controllerName;

                $actionName = 'action'.ucfirst(array_shift($segments));
//                echo '<br>controller name: '.$controllerName;
//                echo '<br>action name: '.$actionName;
                $parameters = $segments;
//                echo '<pre>';
//                print_r($parameters);


//                die();



                // Подключить файл класса-котроллера
                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                // Создать объект, вызвать метод (т.е. action)
                $controllerObject = new $controllerName;
//                $result = $controllerObject->$actionName($parameters);
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
                if ($result != null) {
                    break;
                }
            }
        }
    }
}