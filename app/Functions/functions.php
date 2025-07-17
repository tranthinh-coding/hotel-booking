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

if (!function_exists('isEmpty')) {
    /**
     * Custom empty function with better logic.
     * This replaces PHP's isEmpty() function with more robust checking.
     * 
     * @param mixed $value
     * @return bool
     */
    function isEmpty($value): bool
    {
        // Null values are empty
        if (is_null($value)) {
            return true;
        }
        
        // String handling: empty string or whitespace-only strings are empty
        if (is_string($value)) {
            return trim($value) === '';
        }
        
        // Array handling: empty arrays are empty
        if (is_array($value)) {
            return count($value) === 0;
        }
        
        // Numeric handling: 0 and 0.0 are NOT empty (different from PHP's empty)
        if (is_numeric($value)) {
            return false;
        }
        
        // Boolean handling: false is empty, true is not
        if (is_bool($value)) {
            return $value === false;
        }
        
        // Object handling: check if object has properties
        if (is_object($value)) {
            return count(get_object_vars($value)) === 0;
        }
        
        // Default fallback to PHP's empty for other types
        return isEmpty($value);
    }
}

if (!function_exists('isNotEmpty')) {
    /**
     * Check if a value is not empty using our custom isEmpty function.
     * 
     * @param mixed $value
     * @return bool
     */
    function isNotEmpty($value): bool
    {
        return !isEmpty($value);
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
     * @param string $key
     * @param mixed $value
     */
    function flash_set(string $key, $value): void
    {
        session_start_if_not_started();
        if (!isset($_SESSION['_flash'])) {
            $_SESSION['_flash'] = [];
        }
        $_SESSION['_flash'][$key] = $value;
    }
}

if (!function_exists('flash_get')) {
    /**
     * Get a flash message and remove it.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function flash_get(string $key, $default = null)
    {
        session_start_if_not_started();
        if (isset($_SESSION['_flash'][$key])) {
            $value = $_SESSION['_flash'][$key];
            unset($_SESSION['_flash'][$key]);
            return $value;
        }
        return $default;
    }
}

if (!function_exists('flash_has')) {
    /**
     * Check if a flash message exists.
     *
     * @param string $key
     * @return bool
     */
    function flash_has(string $key): bool
    {
        session_start_if_not_started();
        return isset($_SESSION['_flash'][$key]);
    }
}

if (!function_exists('flash_keep')) {
    /**
     * Keep a flash message for the next request.
     *
     * @param string $key
     */
    function flash_keep(string $key): void
    {
        session_start_if_not_started();
        if (isset($_SESSION['_flash'][$key])) {
            $value = $_SESSION['_flash'][$key];
            flash_set($key, $value);
        }
    }
}

if (!function_exists('flash_success')) {
    /**
     * Set a success flash message.
     *
     * @param string $message
     */
    function flash_success(string $message): void
    {
        flash_set('success', $message);
    }
}

if (!function_exists('flash_error')) {
    /**
     * Set an error flash message.
     *
     * @param string $message
     */
    function flash_error(string $message): void
    {
        flash_set('error', $message);
    }
}

if (!function_exists('flash_warning')) {
    /**
     * Set a warning flash message.
     *
     * @param string $message
     */
    function flash_warning(string $message): void
    {
        flash_set('warning', $message);
    }
}

if (!function_exists('flash_info')) {
    /**
     * Set an info flash message.
     *
     * @param string $message
     */
    function flash_info(string $message): void
    {
        flash_set('info', $message);
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
    function old(string $key, $default = null)
    {
        session_start_if_not_started();
        if (isset($_SESSION['_old_input'][$key])) {
            return $_SESSION['_old_input'][$key];
        }
        return $default;
    }
}

if (!function_exists('old_set')) {
    /**
     * Set old input values.
     *
     * @param array $data
     */
    function old_set(array $data): void
    {
        session_start_if_not_started();
        $_SESSION['_old_input'] = $data;
    }
}

if (!function_exists('old_clear')) {
    /**
     * Clear old input values.
     */
    function old_clear(): void
    {
        session_start_if_not_started();
        unset($_SESSION['_old_input']);
    }
}

if (!function_exists('set_old_input')) {
    /**
     * Set old input values from $_POST automatically.
     */
    function set_old_input(): void
    {
        session_start_if_not_started();
        $_SESSION['_old_input'] = $_POST;
    }
}

if (!function_exists('clear_old_input')) {
    /**
     * Clear old input values (alias for old_clear).
     */
    function clear_old_input(): void
    {
        old_clear();
    }
}

if (!function_exists('set_error')) {
    /**
     * Set a validation error.
     *
     * @param string $field
     * @param string $message
     */
    function set_error(string $field, string $message): void
    {
        session_start_if_not_started();
        if (!isset($_SESSION['_errors'])) {
            $_SESSION['_errors'] = [];
        }
        $_SESSION['_errors'][$field] = $message;
    }
}

if (!function_exists('set_errors')) {
    /**
     * Set multiple validation errors.
     *
     * @param array $errors
     */
    function set_errors(array $errors): void
    {
        session_start_if_not_started();
        $_SESSION['_errors'] = $errors;
    }
}

if (!function_exists('get_error')) {
    /**
     * Get a validation error and remove it.
     *
     * @param string $field
     * @param string $default
     * @return string
     */
    function get_error(string $field, string $default = ''): string
    {
        session_start_if_not_started();
        if (isset($_SESSION['_errors'][$field])) {
            $error = $_SESSION['_errors'][$field];
            unset($_SESSION['_errors'][$field]);
            return $error;
        }
        return $default;
    }
}

if (!function_exists('has_error')) {
    /**
     * Check if a validation error exists.
     *
     * @param string $field
     * @return bool
     */
    function has_error(string $field): bool
    {
        session_start_if_not_started();
        return isset($_SESSION['_errors'][$field]);
    }
}

if (!function_exists('get_errors')) {
    /**
     * Get all validation errors.
     *
     * @return array
     */
    function get_errors(): array
    {
        session_start_if_not_started();
        return $_SESSION['_errors'] ?? [];
    }
}

if (!function_exists('has_errors')) {
    /**
     * Check if any validation errors exist.
     *
     * @return bool
     */
    function has_errors(): bool
    {
        session_start_if_not_started();
        return isNotEmpty($_SESSION['_errors']);
    }
}

if (!function_exists('clear_errors')) {
    /**
     * Clear all validation errors.
     */
    function clear_errors(): void
    {
        session_start_if_not_started();
        unset($_SESSION['_errors']);
    }
}

if (!function_exists('validate_required')) {
    /**
     * Validate that a field is required.
     *
     * @param string $field
     * @param mixed $value
     * @param string $message
     * @return bool
     */
    function validate_required(string $field, $value, ?string $message = null): bool
    {
        if (isEmpty($value) && $value !== '0') {
            $message = $message ?: ucfirst($field) . ' là bắt buộc.';
            set_error($field, $message);
            return false;
        }
        return true;
    }
}

if (!function_exists('validate_email')) {
    /**
     * Validate email format.
     *
     * @param string $field
     * @param string $value
     * @param string $message
     * @return bool
     */
    function validate_email(string $field, string $value, ?string $message = null): bool
    {
        if (isNotEmpty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $message = $message ?: 'Email không đúng định dạng.';
            set_error($field, $message);
            return false;
        }
        return true;
    }
}

if (!function_exists('validate_min_length')) {
    /**
     * Validate minimum length.
     *
     * @param string $field
     * @param string $value
     * @param int $min
     * @param string $message
     * @return bool
     */
    function validate_min_length(string $field, string $value, int $min, ?string $message = null): bool
    {
        if (isNotEmpty($value) && strlen($value) < $min) {
            $message = $message ?: ucfirst($field) . " phải có ít nhất {$min} ký tự.";
            set_error($field, $message);
            return false;
        }
        return true;
    }
}

if (!function_exists('validate_confirmed')) {
    /**
     * Validate that two fields match.
     *
     * @param string $field
     * @param string $value
     * @param string $confirmField
     * @param string $confirmValue
     * @param string $message
     * @return bool
     */
    function validate_confirmed(string $field, string $value, string $confirmField, string $confirmValue, ?string $message = null): bool
    {
        if ($value !== $confirmValue) {
            $message = $message ?: 'Xác nhận không khớp.';
            set_error($confirmField, $message);
            return false;
        }
        return true;
    }
}

if (!function_exists('with_old_input')) {
    /**
     * Store current POST data as old input and redirect with errors.
     *
     * @param string $url
     */
    function with_old_input(string $url): void
    {
        old_set($_POST);
        redirect($url);
    }
}

if (!function_exists('csrf_token')) {
    /**
     * Generate CSRF token.
     *
     * @return string
     */
    function csrf_token(): string
    {
        session_start_if_not_started();
        if (!isset($_SESSION['_csrf_token'])) {
            $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['_csrf_token'];
    }
}

if (!function_exists('csrf_check')) {
    /**
     * Check CSRF token.
     *
     * @param string $token
     * @return bool
     */
    function csrf_check(string $token): bool
    {
        session_start_if_not_started();
        return isset($_SESSION['_csrf_token']) && hash_equals($_SESSION['_csrf_token'], $token);
    }
}

if (!function_exists('csrf_field')) {
    /**
     * Generate CSRF hidden input field.
     *
     * @return string
     */
    function csrf_field(): string
    {
        $token = csrf_token();
        return '<input type="hidden" name="_token" value="' . htmlspecialchars($token) . '">';
    }
}

if (!function_exists('saveFile')) {
    /**
     * Save uploaded file to uploads directory
     *
     * @param array $file The $_FILES array element (e.g., $_FILES['image'])
     * @param string $subFolder Sub folder in uploads directory (optional)
     * @return string|false Returns filename on success, false on failure
     */
    function saveFile($file): string|false
    {
        // Kiểm tra file có được upload không
        if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            return false;
        }

        // Kiểm tra có lỗi upload không
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        // Kiểm tra kích thước file (tối đa 5MB)
        $maxSize = 5 * 1024 * 1024; // 5MB
        if ($file['size'] > $maxSize) {
            return false;
        }

        // Kiểm tra loại file (chỉ cho phép ảnh)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mimeType, $allowedTypes)) {
            return false;
        }

        // Tạo tên file unique
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = uniqid() . '_' . time() . '.' . strtolower($extension);

        // Tạo đường dẫn thư mục
        $uploadDir = __DIR__ . '/../../public/uploads/';

        // Tạo thư mục nếu chưa tồn tại
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Đường dẫn file đầy đủ
        $filePath = $uploadDir . $fileName;

        // Di chuyển file
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            return $fileName;
        }

        return false;
    }
}

if (!function_exists('deleteFile')) {
    /**
     * Delete file from uploads directory
     *
     * @param string $fileName File name to delete
     * @param string $subFolder Sub folder in uploads directory (optional)
     * @return bool Returns true on success, false on failure
     */
    function deleteFile(string $fileName): bool
    {
        if (isEmpty($fileName)) {
            return false;
        }

        // Tạo đường dẫn file
        $uploadDir = __DIR__ . '/../../public/uploads/';
        $filePath = $uploadDir . $fileName;

        // Kiểm tra file có tồn tại không
        if (!file_exists($filePath)) {
            return false;
        }

        // Xóa file
        return unlink($filePath);
    }
}

if (!function_exists('getFileUrl')) {
    /**
     * Get URL for uploaded file
     *
     * @param string $fileName File name
     * @param string $subFolder Sub folder in uploads directory (optional)
     * @return string|null Returns URL on success, null if file doesn't exist
     */
    function getFileUrl(string|null $fileName): string|null
    {
        if (isEmpty($fileName)) {
            return null;
        }

        // Tạo đường dẫn file để kiểm tra tồn tại
        $uploadDir = __DIR__ . '/../../public/uploads/';
        $filePath = $uploadDir . $fileName;

        // Kiểm tra file có tồn tại không
        if (!file_exists($filePath)) {
            return null;
        }

        // Tạo URL
        $url = '/public/uploads/' . $fileName;

        return $url;
    }
}

if (!function_exists('validateImageFile')) {
    /**
     * Validate uploaded image file
     *
     * @param array $file The $_FILES array element
     * @return array Returns validation result with 'valid' boolean and 'error' message
     */
    function validateImageFile($file): array
    {
        // Kiểm tra file có được upload không
        if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            return ['valid' => false, 'error' => 'Không có file được upload'];
        }

        // Kiểm tra có lỗi upload không
        switch ($file['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                return ['valid' => false, 'error' => 'Không có file được chọn'];
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                return ['valid' => false, 'error' => 'File quá lớn'];
            default:
                return ['valid' => false, 'error' => 'Có lỗi xảy ra khi upload file'];
        }

        // Kiểm tra kích thước file (tối đa 5MB)
        $maxSize = 5 * 1024 * 1024; // 5MB
        if ($file['size'] > $maxSize) {
            return ['valid' => false, 'error' => 'File không được vượt quá 5MB'];
        }

        // Kiểm tra loại file (chỉ cho phép ảnh)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($mimeType, $allowedTypes) || !in_array($extension, $allowedExtensions)) {
            return ['valid' => false, 'error' => 'Chỉ chấp nhận file ảnh (JPG, PNG, GIF, WebP)'];
        }

        return ['valid' => true, 'error' => ''];
    }
}

if (!function_exists('safe_substr')) {
    /**
     * UTF-8 safe substring function
     *
     * @param string $text
     * @param int $start
     * @param int $length
     * @return string
     */
    function safe_substr(string $text, int $start, ?int $length = null): string
    {
        if ($length === null) {
            return mb_substr($text, $start, null, 'UTF-8');
        }
        return mb_substr($text, $start, $length, 'UTF-8');
    }
}

if (!function_exists('safe_strlen')) {
    /**
     * UTF-8 safe string length function
     *
     * @param string $text
     * @return int
     */
    function safe_strlen(string $text): int
    {
        return mb_strlen($text, 'UTF-8');
    }
}

if (!function_exists('truncate_text')) {
    /**
     * Truncate text with UTF-8 support
     *
     * @param string $text
     * @param int $length
     * @param string $suffix
     * @return string
     */
    function truncate_text(string $text, int $length = 100, string $suffix = '...'): string
    {
        if (safe_strlen($text) <= $length) {
            return $text;
        }
        
        return safe_substr($text, 0, $length) . $suffix;
    }
}

if (!function_exists('safe_htmlspecialchars')) {
    /**
     * UTF-8 safe htmlspecialchars
     *
     * @param string $text
     * @return string
     */
    function safe_htmlspecialchars(string $text): string
    {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }
}
