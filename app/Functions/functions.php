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

        $view = str_replace('.', '/', $view);
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

if (!function_exists('back')) {
    /**
     * Redirect back to the previous page.
     */
    function back(): void
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? '/';
        redirect($referer);
    }
}

if (!function_exists('session_start_if_not_started')) {
    /**
     * Start session if not already started.
     */
    function session_start_if_not_started(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}

if (!function_exists('session_set')) {
    /**
     * Set a session value.
     *
     * @param string $key
     * @param mixed $value
     */
    function session_set(string $key, $value): void
    {
        session_start_if_not_started();
        $_SESSION[$key] = $value;
    }
}

if (!function_exists('session_get')) {
    /**
     * Get a session value.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function session_get(string $key, $default = null)
    {
        session_start_if_not_started();
        return $_SESSION[$key] ?? $default;
    }
}

if (!function_exists('session_remove')) {
    /**
     * Remove a session value.
     *
     * @param string $key
     */
    function session_remove(string $key): void
    {
        session_start_if_not_started();
        unset($_SESSION[$key]);
    }
}

if (!function_exists('session_destroy_all')) {
    /**
     * Destroy all session data.
     */
    function session_destroy_all(): void
    {
        session_start_if_not_started();
        session_destroy();
    }
}

if (!function_exists('user')) {
    /**
     * Get the currently authenticated user.
     *
     * @return \HotelBooking\Models\TaiKhoan|null
     */
    function user()
    {
        $userId = session_get('user_id');
        if (!$userId) {
            return null;
        }

        try {
            return \HotelBooking\Models\TaiKhoan::find($userId);
        } catch (Exception $e) {
            return null;
        }
    }
}

if (!function_exists('auth_check')) {
    /**
     * Check if user is authenticated.
     *
     * @return bool
     */
    function auth_check(): bool
    {
        return user() !== null;
    }
}

if (!function_exists('auth_login')) {
    /**
     * Log in a user.
     *
     * @param \HotelBooking\Models\TaiKhoan $user
     */
    function auth_login($user): void
    {
        session_set('user_id', $user->ma_tai_khoan);
        session_set('user_role', $user->phan_quyen);
    }
}

if (!function_exists('auth_logout')) {
    /**
     * Log out the current user.
     */
    function auth_logout(): void
    {
        session_remove('user_id');
        session_remove('user_role');
    }
}

if (!function_exists('auth_guest')) {
    /**
     * Check if user is a guest (not authenticated).
     *
     * @return bool
     */
    function auth_guest(): bool
    {
        return !auth_check();
    }
}

if (!function_exists('flash_set')) {
    /**
     * Set a flash message.
     *
     * @param string $type
     * @param string $message
     */
    function flash_set(string $type, string $message): void
    {
        session_set("flash_{$type}", $message);
    }
}

if (!function_exists('flash_get')) {
    /**
     * Get and remove a flash message.
     *
     * @param string $type
     * @return string|null
     */
    function flash_get(string $type): ?string
    {
        $message = session_get("flash_{$type}");
        if ($message) {
            session_remove("flash_{$type}");
        }
        return $message;
    }
}

if (!function_exists('old')) {
    /**
     * Get old input value.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function old(string $key, $default = '')
    {
        return session_get("old_{$key}", $default);
    }
}

if (!function_exists('set_old_input')) {
    /**
     * Set old input values.
     */
    function set_old_input(): void
    {
        foreach ($_POST as $key => $value) {
            session_set("old_{$key}", $value);
        }
    }
}

if (!function_exists('clear_old_input')) {
    /**
     * Clear old input values.
     */
    function clear_old_input(): void
    {
        foreach ($_SESSION as $key => $value) {
            if (strpos($key, 'old_') === 0) {
                session_remove($key);
            }
        }
    }
}

if (!function_exists('layout')) {
    /**
     * Render a view with layout.
     *
     * @param string $view
     * @param array $data
     * @param string $layout
     */
    function layout(string $view, array $data = [], string $layout = 'layouts.app'): void
    {
        // Start output buffering for content
        ob_start();
        
        // Render the view content
        view($view, $data);
        
        // Get the content
        $content = ob_get_clean();
        
        // Add content to data
        $data['content'] = $content;
        
        // Render the layout
        view($layout, $data);
    }
}
