<?php

declare (strict_types = 1);

namespace  App;

use App\Exceptions\ViewNotFoundException;

class Views
{
    public function __construct(protected string $view, protected array $params = []) {
    }

    public static function make(string $view, array $params = []): static
    {
        return new static($view, $params);
    }

    public function render(): string
    {
        $viewPath = VIEWS_PATH . $this->view . '.php';

        if (! file_exists($viewPath)) {
            throw new ViewNotFoundException();
        }

        /*this is going to do the same thing as the foreach */
        extract($this->params);

        ob_start();

        include $viewPath;

        return (string) ob_get_clean();
    }

    public function __toString()
    {
        return $this->render();
    }

    public function __get(string $name)
    {
        return $this->params[$name] ?? null;
    }
}