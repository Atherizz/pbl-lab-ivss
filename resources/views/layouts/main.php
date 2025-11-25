<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo isset($title) ? htmlspecialchars($title) : 'Lab IVSS'; ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
/* Dark slate + cyan theme for public pages */
.theme-slate { background-color: #0f172a; color: #e2e8f0; }
.theme-slate .bg-gray-100 { background-color: #0f172a !important; }
.theme-slate .bg-white { background-color: #1f2937 !important; }
.theme-slate .text-gray-900, .theme-slate .text-gray-800 { color: #e2e8f0 !important; }
.theme-slate .text-gray-700 { color: #cbd5e1 !important; }
.theme-slate .text-gray-600 { color: #94a3b8 !important; }
.theme-slate .border-gray-200, .theme-slate .border-gray-300 { border-color: #334155 !important; }
.theme-slate .focus\:ring-blue-500:focus { --tw-ring-color: #06b6d4 !important; }
.theme-slate .focus\:border-blue-500:focus { border-color: #06b6d4 !important; }
/* Public form controls tone */
.theme-slate input[type="text"],
.theme-slate input[type="password"],
.theme-slate input[type="email"],
.theme-slate input[type="url"],
.theme-slate input[type="tel"],
.theme-slate input[type="number"],
.theme-slate input[type="date"],
.theme-slate input[type="time"],
.theme-slate input[type="search"],
.theme-slate select,
.theme-slate textarea {
    background-color: #0b1220 !important;
    color: #e2e8f0 !important;
    border: 1px solid #334155 !important;
    border-radius: 0.5rem;
    padding: 0.5rem 0.75rem !important;
    line-height: 1.5rem !important;
    min-height: 2.75rem;
}
.theme-slate input::placeholder,
.theme-slate textarea::placeholder { color: #64748b !important; }
.theme-slate input:focus,
.theme-slate select:focus,
.theme-slate textarea:focus { outline: none !important; border-color: #06b6d4 !important; box-shadow: 0 0 0 3px rgba(6,182,212,.25) !important; }
</style>
</head>

<body class="font-sans antialiased theme-slate">
    <div class="min-h-screen bg-gray-100">
        <?php if (isset($header)): ?>
            <header class="bg-slate-800 border-b border-slate-700 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <?php echo htmlspecialchars($header); ?>
                </div>
            </header>
        <?php endif; ?>

        <main>
            <?= $content ?>
        </main>
    </div>
</body>

</html>
