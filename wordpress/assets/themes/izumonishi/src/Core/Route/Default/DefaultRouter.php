<?php declare(strict_types=1);
namespace Mvc4Wp\Core\Route\Default;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Mvc4Wp\Core\Config\ConfiguratorInterface;
use Mvc4Wp\Core\Library\Castable;
use Mvc4Wp\Core\Library\HttpStatus;
use Mvc4Wp\Core\Route\Delimiter;
use Mvc4Wp\Core\Route\RouteHandler;
use Mvc4Wp\Core\Route\RouterInterface;
use Mvc4Wp\Core\Route\Routerable;
use App\Controller\SingularController;
class DefaultRouter implements RouterInterface
{
    use Castable, Routerable;
    public function dispatch(ConfiguratorInterface $config, string $request_method, string $request_uri): RouteHandler
    {
        //  Parse the URL components
        $parsed_url = parse_url($request_uri);
        $request_path = $parsed_url['path'] ?? '/';
        $query_string = $parsed_url['query'] ?? '';
        parse_str($query_string, $query_params);

        //  Handle WordPress previews BEFORE routing
        if (!empty($query_params['p']) && !empty($query_params['preview']) && $query_params['preview'] === 'true') {
            return $this->handleWordPressPreview($query_params);
        }

        //  Process normal routing via FastRoute
        $routes = $this->routes;
        $dispatcher = \FastRoute\simpleDispatcher(function (RouteCollector $r) use ($config, $routes) {
            foreach ($routes as $key => $value) {
                $keys = explode(Delimiter::STATUS_DELIMITER, $key);
                $httpMethod = $keys[0];
                $uris = explode(Delimiter::ROUTE_DELIMITER, $keys[1]);
                foreach ($uris as $uri) {
                    $r->addRoute($httpMethod, $uri, $value);
                }
            }
        });

        //  Dispatch using only the request path
        $routeInfo = $dispatcher->dispatch(strtoupper($request_method), $request_path);

        //  Return the correct RouteHandler
        return match ($routeInfo[0]) {
            Dispatcher::NOT_FOUND => new RouteHandler(HttpStatus::NOT_FOUND),
            Dispatcher::METHOD_NOT_ALLOWED => new RouteHandler(HttpStatus::METHOD_NOT_ALLOWED),
            Dispatcher::FOUND => new RouteHandler(HttpStatus::OK, $routeInfo[1], $routeInfo[2]),
        };
    }

    /**
     *  Handle WordPress Preview Requests
     */
    private function handleWordPressPreview(array $query_params): RouteHandler
    {
        $post_id = filter_var($query_params['p'], FILTER_VALIDATE_INT);
        if (!$post_id) {
            return new RouteHandler(HttpStatus::NOT_FOUND);
        }

        $post_type = $query_params['post_type'] ?? 'post';

        //  Convert post type to PascalCase for Controller Naming
        $controller_base = str_replace(' ', '', ucwords(str_replace('_', ' ', $post_type)));
        $controller_class = "\\App\\Controller\\{$controller_base}SingularController";

        //  Fallback to default SingularController if the specific one doesn’t exist
        if (!class_exists($controller_class)) {
            // $controller_class = \App\Controller\SingularController::class;
            $controller_class = SingularController::class;
        }

        return new RouteHandler(
            HttpStatus::OK,
            $controller_class . '::index',
            [
                'id' => $post_id,
                'post_type' => $post_type,
            ]
        );
    }


}