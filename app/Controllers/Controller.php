<?php

namespace App\Controllers;

use CoffeeCode\Router\Router;
use League\Plates\Engine;

/**
 * Class Controller
 * @package Source\Controllers
 */
abstract class Controller
{
    /** @var Engine */
    protected $view;

    /** @var Router */
    protected $router;

    /**
     * Controller constructor.
     * @param $router
     */
    public function __construct($router)
    {
        $this->router = $router;
    }

    public function view(string $view, array $data = [])
    {
        $viewPath = dirname(__DIR__, 2) . "/views";
        if (!file_exists($viewPath . DIRECTORY_SEPARATOR . $view . ".php")) {
            throw new \Exception("A view {$view} não existe");
        }
        $templates = new Engine($viewPath, "php");
        $templates->addData(["router" => $this->router]);
        echo $templates->render($view, $data);
    }
}
