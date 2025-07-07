<?php

// functions in global namespace

if (!function_exists('dd')) {
    /**
     * Dump and die.
     *
     * @param mixed $data
     */
    function dd($data): void
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        die();
    }
}

if (!function_exists('redirect')) {
    /**
     * Redirect to a given URL.
     *
     * @param string $url
     */
    function redirect(string $url): void
    {
        header("Location: $url");
        exit();
    }
}

if (!function_exists('view')) {
    /**
     * Render a view file.
     *
     * @param string $view
     * @param array $data
     */
    function view(string $view, array $data = []): void
    {
        extract($data);
        $viewPath = __DIR__ . '/../Views/' . $view . '.php';
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            http_response_code(404);
            echo "View not found: $view";
        }
    }
}

if (!function_exists('get')) {
    /**
     * Get a value from the $_GET superglobal.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function get(string $key, $default = null)
    {
        return $_GET[$key] ?? $default;
    }
}

if (!function_exists('post')) {
    /**
     * Get a value from the $_POST superglobal.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function post(string $key, $default = null)
    {
        return $_POST[$key] ?? $default;
    }
}
