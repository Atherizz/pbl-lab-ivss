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