<?php
namespace App\Core\RequestDispatcher;

use App\Authentication\Service\AuthenticationServiceInterface;
use App\Authentication\UserTokenInterface;

class BaseController
{
    const AUTHENTICATION = 'auth';

    /**
     * @var AuthenticationServiceInterface
     */
    protected $authService;

    public function __construct(
        AuthenticationServiceInterface $authService
    ) {
        $this->authService = $authService;
    }

    public function request(): RequestInterface
    {
        return $this->request;
    }

    public function response(): ResponseInterface
    {
        return new Response();
    }

    public function xmlResponse(): ResponseInterface
    {
        return new XmlResponse();
    }

    public function jsonResponse(): ResponseInterface
    {
        return new JsonResponse();
    }

    public function renderTemplate(string $pathToTemplate, array $bindings = []): ResponseInterface
    {
        $callable = function () use ($pathToTemplate, $bindings) {
            return $this->renderTemplateWithLayout($pathToTemplate, $bindings);
        };

        return (new Response())
            ->setContent(
                new class($callable) {
                    private $callback;

                    public function __construct($callback) {
                        $this->callback = $callback;
                    }

                    public function __toString() {
                        try {
                            return call_user_func($this->callback);
                        } catch (\Exception $e) {
                            // 
                        }
                    }
                }
            );
    }

    /**
     * $param url 
     * redirect url
     */
    public function redirect($url): ResponseInterface
    {
        $response = $this->response();
        $response->setHTTPCode(301);
        $response->setHeader("Location", $url);

        return $response;
    }

    private function renderTemplateWithLayout(string $pathToTemplate, array $bindings = [])
    {
        ob_start();
        include TEMPLATE_DIR . '/layout/header.inc.php';
        $view = new View();
        print $view->render($pathToTemplate, $bindings);
        include TEMPLATE_DIR . '/layout/footer.inc.php';
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    protected function getUserToken(Request $request): UserTokenInterface
    {
        $cookie = $request->getCookie();
        $auth = $cookie[self::AUTHENTICATION];

        return $this->authService->authenticate($auth);
    }
}
