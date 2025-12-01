<?php
function view($view, $data = []): void
{
    $viewPath = str_replace('.', '/', $view);
    extract($data);

    ob_start();

    $fullViewPath = BASE_PATH . "/resources/views/{$viewPath}.php";
    if (file_exists($fullViewPath)) {
        require $fullViewPath;
    } else {
        echo "<p style='color:red; font-weight:bold;'>View file not found: {$fullViewPath}</p>";
    }

    $content = ob_get_clean();
    extract(['content' => $content]);

    require BASE_PATH . "/resources/views/layouts/main.php";
}

/**
 * Retrieve a flash message from session and remove it so it won't persist on refresh.
 * Usage: if ($msg = flash('success')) { echo $msg; }
 */
function flash(string $key, $default = null): ?string
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION[$key])) {
        return $default;
    }
    $value = $_SESSION[$key];
    unset($_SESSION[$key]);
    return is_string($value) ? $value : json_encode($value);
}

/**
 * Set a flash message (helper for controllers/services).
 */
function set_flash(string $key, string $message): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION[$key] = $message;
}

function pagination(int $itemsPerPage, int $currentPage, array $allData, string $varName)
{

    $totalItems = count($allData);
    $totalPages = max(1, ceil($totalItems / $itemsPerPage));
    $currentPage = min($currentPage, $totalPages);

    $offset = ($currentPage - 1) * $itemsPerPage;
    $data = array_slice($allData, $offset, $itemsPerPage);

    $startItem = $totalItems > 0 ? $offset + 1 : 0;
    $endItem = min($offset + $itemsPerPage, $totalItems);

    return [
        $varName => $data,
        'currentPage' => $currentPage,
        'totalPages' => $totalPages,
        'totalItems' => $totalItems,
        'itemsPerPage' => $itemsPerPage,
        'startItem' => $startItem,
        'endItem' => $endItem,
    ];
}
