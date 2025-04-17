<?php
session_start();
$themes = [
    'cyberpunk' => [
        'name' => 'Cyberpunk 2077',
        'codemirror' => 'nord',
        'navbar' => 'dark',
        'bg' => '#0c0e1a',
        'primary' => '#ff2a6d',
        'secondary' => '#05d9e8',
        'text' => '#d1f7ff',
        'editor_bg' => '#12172d',
        'output_bg' => '#12172d',
        'terminal_bg' => '#0c0e1a',
        'terminal_text' => '#d1f7ff',
        'border_color' => '#05d9e8',
        'error_color' => '#ff2a6d',
        'warning_color' => '#ffcc00',
        'success_color' => '#00ff9f',
        'accent_color' => '#bd00ff',
        'highlight_color' => '#05d9e8',
        'background_pattern' => 'linear-gradient(135deg, rgba(5, 217, 232, 0.05) 0%, rgba(189, 0, 255, 0.05) 100%)',
        'terminal_pattern' => 'radial-gradient(circle at 10% 20%, rgba(255, 42, 109, 0.03) 0%, rgba(5, 217, 232, 0.03) 90%)'
    ],
    'neon-dream' => [
        'name' => 'Neon Dream',
        'codemirror' => 'dracula',
        'navbar' => 'dark',
        'bg' => '#0a0a1a',
        'primary' => '#ff00aa',
        'secondary' => '#00ffcc',
        'text' => '#e0e0ff',
        'editor_bg' => '#0f0f2d',
        'output_bg' => '#0f0f2d',
        'terminal_bg' => '#0a0a1a',
        'terminal_text' => '#e0e0ff',
        'border_color' => '#00ffcc',
        'error_color' => '#ff0066',
        'warning_color' => '#ffcc00',
        'success_color' => '#00ff88',
        'accent_color' => '#aa00ff',
        'highlight_color' => '#00ffff',
        'background_pattern' => 'linear-gradient(135deg, rgba(170, 0, 255, 0.05) 0%, rgba(0, 255, 204, 0.05) 100%)',
        'terminal_pattern' => 'linear-gradient(135deg, rgba(255, 0, 170, 0.03) 0%, rgba(0, 255, 204, 0.03) 100%)'
    ],
    'matrix-reloaded' => [
        'name' => 'Matrix Reloaded',
        'codemirror' => 'blackboard',
        'navbar' => 'dark',
        'bg' => '#000000',
        'primary' => '#00ff41',
        'secondary' => '#008f11',
        'text' => '#ffffff',
        'editor_bg' => '#0a0a0a',
        'output_bg' => '#0a0a0a',
        'terminal_bg' => '#000000',
        'terminal_text' => '#00ff41',
        'border_color' => '#00ff41',
        'error_color' => '#ff5555',
        'warning_color' => '#ffb86c',
        'success_color' => '#50fa7b',
        'accent_color' => '#00d3ff',
        'highlight_color' => '#00ff41',
        'background_pattern' => 'linear-gradient(rgba(0, 255, 65, 0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(0, 255, 65, 0.05) 1px, transparent 1px)',
        'terminal_pattern' => 'radial-gradient(rgba(0, 255, 65, 0.1) 1px, transparent 1px)'
    ],
    'solar-flare' => [
        'name' => 'Solar Flare',
        'codemirror' => 'solarized',
        'navbar' => 'light',
        'bg' => '#fdf6e3',
        'primary' => '#268bd2',
        'secondary' => '#2aa198',
        'text' => '#586e75',
        'editor_bg' => '#fdf6e3',
        'output_bg' => '#eee8d5',
        'terminal_bg' => '#eee8d5',
        'terminal_text' => '#586e75',
        'border_color' => '#268bd2',
        'error_color' => '#dc322f',
        'warning_color' => '#b58900',
        'success_color' => '#859900',
        'accent_color' => '#6c71c4',
        'highlight_color' => '#2aa198',
        'background_pattern' => 'linear-gradient(135deg, rgba(38, 139, 210, 0.05) 0%, rgba(42, 161, 152, 0.05) 100%)',
        'terminal_pattern' => 'linear-gradient(135deg, rgba(203, 75, 22, 0.03) 0%, rgba(42, 161, 152, 0.03) 100%)'
    ],
    'deep-space' => [
        'name' => 'Deep Space',
        'codemirror' => 'material',
        'navbar' => 'dark',
        'bg' => '#0a0e14',
        'primary' => '#ff7b72',
        'secondary' => '#79c0ff',
        'text' => '#c9d1d9',
        'editor_bg' => '#0a0e14',
        'output_bg' => '#161b22',
        'terminal_bg' => '#161b22',
        'terminal_text' => '#c9d1d9',
        'border_color' => '#79c0ff',
        'error_color' => '#ff7b72',
        'warning_color' => '#ffa657',
        'success_color' => '#7ee787',
        'accent_color' => '#d2a8ff',
        'highlight_color' => '#79c0ff',
        'background_pattern' => 'linear-gradient(135deg, rgba(121, 192, 255, 0.05) 0%, rgba(255, 123, 114, 0.05) 100%)',
        'terminal_pattern' => 'radial-gradient(circle at 70% 30%, rgba(121, 192, 255, 0.03) 0%, rgba(255, 123, 114, 0.03) 100%)'
    ]
];

if (isset($_GET['theme']) && array_key_exists($_GET['theme'], $themes)) {
    $_SESSION['theme'] = $_GET['theme'];
}
$current_theme = $_SESSION['theme'] ?? 'solar-flare';
$theme = $themes[$current_theme];

$files = $_SESSION['files'] ?? [
    'main.cpp' => ''
];
$current_file = $_SESSION['current_file'] ?? 'main.cpp';

if (isset($_POST['code'])) {
    $files[$current_file] = $_POST['code'];
    $_SESSION['files'] = $files;
}

if (isset($_GET['file'])) {
    $current_file = $_GET['file'];
    $_SESSION['current_file'] = $current_file;
}

if (isset($_POST['new_file'])) {
    $new_name = $_POST['new_file_name'];
    if (!empty($new_name)) {
        if (!str_ends_with($new_name, '.cpp')) {
            $new_name .= '.cpp';
        }
        $files[$new_name] = '// ' . $new_name . "";
        $_SESSION['files'] = $files;
        $current_file = $new_name;
        $_SESSION['current_file'] = $current_file;
    }
}

if (isset($_GET['delete_file'])) {
    unset($files[$_GET['delete_file']]);
    $_SESSION['files'] = $files;
    if ($current_file === $_GET['delete_file']) {
        $current_file = array_key_first($files) ?? 'main.cpp';
        $_SESSION['current_file'] = $current_file;
    }
}

$output = '';
$compilation_success = false;
$needs_input = false;
$executable_path = '';

if (isset($_POST['compile'])) {
    try {
        $code = $_POST['code'] ?? $files[$current_file];
        $temp_dir = sys_get_temp_dir();
        $temp_file = tempnam($temp_dir, 'cpp_') . '.cpp';
        file_put_contents($temp_file, $code);

        $executable_path = str_replace('.cpp', '', $temp_file);

        exec("g++ -std=c++17 -Wall -Wextra -pedantic \"{$temp_file}\" -o \"{$executable_path}\" 2>&1", $compile_output, $return_code);

        if ($return_code === 0) {
            $compilation_success = true;
            chmod($executable_path, 0755);
            $_SESSION['executable'] = $executable_path;

            if (strpos($code, 'cin') !== false || strpos($code, 'getline') !== false) {
                $needs_input = true;
                $output = "<span style='color:{$theme['primary']}'>💻 Program is waiting for input...</span>";
            } else {
                exec("\"{$executable_path}\" 2>&1", $run_output, $run_return_code);
                $output = implode("\n", $run_output);

                if ($run_return_code !== 0) {
                    $output .= "\n\n<span style='color:{$theme['error_color']}'>❌ Program exited with code {$run_return_code}</span>";
                }

                if (file_exists($executable_path)) unlink($executable_path);
                unset($_SESSION['executable']);
            }
        } else {
            $error_lines = [];
            foreach ($compile_output as $line) {
                if (preg_match('/error:/i', $line)) {
                    $line = "<span style='color:{$theme['error_color']}'>✖ " . htmlspecialchars($line) . "</span>";
                } elseif (preg_match('/warning:/i', $line)) {
                    $line = "<span style='color:{$theme['warning_color']}'>⚠ " . htmlspecialchars($line) . "</span>";
                } else {
                    $line = htmlspecialchars($line);
                }
                $error_lines[] = $line;
            }
            $output = implode("\n", $error_lines);
        }

        if (file_exists($temp_file)) unlink($temp_file);
    } catch (Exception $e) {
        $output = "<span style='color:{$theme['error_color']}'>❌ Compile error: " . htmlspecialchars($e->getMessage()) . "</span>";
    }
}

if (isset($_POST['program_input'])) {
    if (!empty($_SESSION['executable']) && file_exists($_SESSION['executable'])) {
        $executable_path = $_SESSION['executable'];
        $input = $_POST['program_input'];

        $descriptors = [
            0 => ['pipe', 'r'],
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w']
        ];

        $process = proc_open("\"{$executable_path}\"", $descriptors, $pipes);

        if (is_resource($process)) {
            fwrite($pipes[0], $input);
            fclose($pipes[0]);

            $output = stream_get_contents($pipes[1]);
            $errors = stream_get_contents($pipes[2]);

            fclose($pipes[1]);
            fclose($pipes[2]);

            $return_code = proc_close($process);

            if (!empty($errors)) {
                $output .= "\n\n" . $errors;
            }

            if ($return_code !== 0) {
                $output .= "\n\n<span style='color:{$theme['error_color']}'>❌ Program exited with code {$return_code}</span>";
            }
            if (file_exists($executable_path)) unlink($executable_path);
            unset($_SESSION['executable']);
        }
    }
}
if (isset($_POST['format'])) {
    try {
        $code = $_POST['code'] ?? $files[$current_file];
        $temp_file = tempnam(sys_get_temp_dir(), 'cpp_');
        file_put_contents($temp_file, $code);

        exec("clang-format -style=file -i {$temp_file}");
        $formatted_code = file_get_contents($temp_file);

        $files[$current_file] = $formatted_code;
        $_SESSION['files'] = $files;

        unlink($temp_file);

        $output = "<span style='color:{$theme['success_color']}'>✨ Code formatted successfully!</span>";
    } catch (Exception $e) {
        $output = "<span style='color:{$theme['error_color']}'>❌ Formatting error: " . htmlspecialchars($e->getMessage()) . "</span>";
    }
}

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    header('Content-Type: application/json');
    echo json_encode([
        'output' => $output,
        'needs_input' => $needs_input,
        'code' => $files[$current_file] ?? ''
    ]);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber C++ IDE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/iconfont/tabler-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/<?= $theme['codemirror'] ?>.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/addon/hint/show-hint.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/addon/fold/foldgutter.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500&family=Orbitron:wght@500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: <?= $theme['bg'] ?>;
            --primary-color: <?= $theme['primary'] ?>;
            --secondary-color: <?= $theme['secondary'] ?>;
            --text-color: <?= $theme['text'] ?>;
            --editor-bg: <?= $theme['editor_bg'] ?>;
            --output-bg: <?= $theme['output_bg'] ?>;
            --terminal-bg: <?= $theme['terminal_bg'] ?>;
            --terminal-text: <?= $theme['terminal_text'] ?>;
            --border-color: <?= $theme['border_color'] ?>;
            --error-color: <?= $theme['error_color'] ?>;
            --warning-color: <?= $theme['warning_color'] ?>;
            --success-color: <?= $theme['success_color'] ?>;
            --accent-color: <?= $theme['accent_color'] ?>;
            --highlight-color: <?= $theme['highlight_color'] ?>;
            --navbar-bg: <?= $theme['navbar'] === 'dark' ? 'rgba(18, 18, 18, 0.9)' : 'rgba(248, 249, 250, 0.9)' ?>;
            --navbar-text: <?= $theme['navbar'] === 'dark' ? '#ffffff' : '#212529' ?>;
        }

        .card {
            --bs-card-cap-color: <?= $theme['text'] ?>;
            --bs-card-color: <?= $theme['text'] ?>;
        }

        body {
            background-color: var(--bg-color);
            background-image: <?= $theme['background_pattern'] ?>;
            color: var(--text-color);
            font-family: 'Fira Code', monospace;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .navbar-ide {
            background-color: var(--navbar-bg) !important;
            color: var(--navbar-text) !important;
            border-bottom: 1px solid var(--border-color);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .navbar-brand {
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            letter-spacing: 1px;
            color: var(--primary-color) !important;
            text-shadow: 0 0 5px rgba(<?= hexdec(substr($theme['primary'], 1, 2)) ?>, <?= hexdec(substr($theme['primary'], 3, 2)) ?>, <?= hexdec(substr($theme['primary'], 5, 2)) ?>, 0.3);
        }

        .editor-container {
            height: 60vh;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            background: var(--editor-bg);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .editor-container:hover {
            box-shadow: 0 4px 25px rgba(<?= hexdec(substr($theme['primary'], 1, 2)) ?>, <?= hexdec(substr($theme['primary'], 3, 2)) ?>, <?= hexdec(substr($theme['primary'], 5, 2)) ?>, 0.3);
        }

        .CodeMirror {
            height: 100% !important;
            font-family: 'Fira Code', monospace;
            font-size: 14px;
            background: var(--editor-bg);
            padding: 10px 0;
        }

        .CodeMirror-gutters {
            background: var(--editor-bg) !important;
            border-right: 1px solid rgba(<?= hexdec(substr($theme['primary'], 1, 2)) ?>, <?= hexdec(substr($theme['primary'], 3, 2)) ?>, <?= hexdec(substr($theme['primary'], 5, 2)) ?>, 0.2) !important;
        }

        .terminal-container {
            background-color: var(--terminal-bg);
            background-image: <?= $theme['terminal_pattern'] ?>;
            color: var(--terminal-text);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            height: 30vh;
            overflow-y: auto;
            padding: 15px;
            font-family: 'Fira Code', monospace;
            white-space: pre-wrap;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .terminal-input {
            background-color: var(--editor-bg);
            color: var(--terminal-text);
            border: 1px solid var(--border-color);
            width: 100%;
            padding: 12px 15px;
            font-family: 'Fira Code', monospace;
            border-radius: 6px;
            transition: all 0.3s;
        }

        .terminal-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(<?= hexdec(substr($theme['primary'], 1, 2)) ?>, <?= hexdec(substr($theme['primary'], 3, 2)) ?>, <?= hexdec(substr($theme['primary'], 5, 2)) ?>, 0.3);
            outline: none;
        }

        .btn-ide {
            background-color: var(--primary-color);
            color: <?= $theme['navbar'] === 'dark' ? '#121212' : '#ffffff' ?>;
            border: none;
            transition: all 0.3s;
            font-weight: 500;
            letter-spacing: 0.5px;
            padding: 8px 16px;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .btn-ide:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            color: <?= $theme['navbar'] === 'dark' ? '#121212' : '#ffffff' ?>;
            box-shadow: 0 4px 10px rgba(<?= hexdec(substr($theme['secondary'], 1, 2)) ?>, <?= hexdec(substr($theme['secondary'], 3, 2)) ?>, <?= hexdec(substr($theme['secondary'], 5, 2)) ?>, 0.3);
        }

        .btn-ide:active {
            transform: translateY(0);
        }

        .file-item {
            transition: all 0.3s;
            border-left: 3px solid transparent;
            background-color: var(--navbar-bg);
            color: var(--text-color);
            margin-bottom: 5px;
            border-radius: 5px;
            padding: 10px 15px;
        }

        .file-item:hover {
            background-color: <?= $theme['navbar'] === 'dark' ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.1)' ?> !important;
            transform: translateX(5px);
        }

        .active-file {
            border-left: 3px solid var(--primary-color) !important;
            background-color: <?= $theme['navbar'] === 'dark' ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.1)' ?> !important;
            font-weight: 500;
        }

        .theme-selector {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: inline-block;
            cursor: pointer;
            border: 2px solid var(--text-color);
            transition: all 0.3s;
            margin-left: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .theme-selector:hover {
            transform: scale(1.2);
            box-shadow: 0 0 10px rgba(<?= hexdec(substr($theme['primary'], 1, 2)) ?>, <?= hexdec(substr($theme['primary'], 3, 2)) ?>, <?= hexdec(substr($theme['primary'], 5, 2)) ?>, 0.5);
        }

        .modal-content {
            background-color: var(--editor-bg);
            color: var(--text-color);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            border-bottom: 1px solid var(--border-color);
            background-color: var(--primary-color);
            color: #121212;
            font-weight: bold;
        }

        .modal-footer {
            border-top: 1px solid var(--border-color);
        }

        .form-control {
            background-color: var(--editor-bg);
            color: var(--text-color);
            border: 1px solid var(--border-color);
            padding: 10px 15px;
            border-radius: 6px;
            transition: all 0.3s;
        }

        .form-control:focus {
            background-color: var(--editor-bg);
            color: var(--text-color);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(<?= hexdec(substr($theme['primary'], 1, 2)) ?>, <?= hexdec(substr($theme['primary'], 3, 2)) ?>, <?= hexdec(substr($theme['primary'], 5, 2)) ?>, 0.25);
        }

        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: var(--editor-bg);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 5px;
            transition: all 0.3s;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--secondary-color);
        }
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(<?= hexdec(substr($theme['primary'], 1, 2)) ?>, <?= hexdec(substr($theme['primary'], 3, 2)) ?>, <?= hexdec(substr($theme['primary'], 5, 2)) ?>, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(<?= hexdec(substr($theme['primary'], 1, 2)) ?>, <?= hexdec(substr($theme['primary'], 3, 2)) ?>, <?= hexdec(substr($theme['primary'], 5, 2)) ?>, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(<?= hexdec(substr($theme['primary'], 1, 2)) ?>, <?= hexdec(substr($theme['primary'], 3, 2)) ?>, <?= hexdec(substr($theme['primary'], 5, 2)) ?>, 0);
            }
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        <?php if ($current_theme === 'cyberpunk'): ?>.navbar-brand {
            text-shadow: 0 0 10px var(--primary-color), 0 0 20px var(--secondary-color);
        }

        .btn-ide {
            position: relative;
            overflow: hidden;
        }

        .btn-ide::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(to bottom right,
                    transparent,
                    transparent,
                    transparent,
                    var(--highlight-color));
            transform: rotate(30deg);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% {
                transform: rotate(30deg) translate(-30%, -30%);
            }

            100% {
                transform: rotate(30deg) translate(30%, 30%);
            }
        }

        <?php endif; ?>.error-message {
            color: var(--error-color);
            font-weight: bold;
        }

        .warning-message {
            color: var(--warning-color);
            font-weight: bold;
        }

        .success-message {
            color: var(--success-color);
            font-weight: bold;
        }


        .card-ide {
            background-color: var(--editor-bg);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s;
        }

        .card-ide:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(<?= hexdec(substr($theme['primary'], 1, 2)) ?>, <?= hexdec(substr($theme['primary'], 3, 2)) ?>, <?= hexdec(substr($theme['primary'], 5, 2)) ?>, 0.3);
        }


        .terminal-prompt {
            color: var(--primary-color);
            font-weight: bold;
        }

        .terminal-output {
            color: var(--terminal-text);
            line-height: 1.6;
        }

        .terminal-error {
            color: var(--error-color);
            font-weight: bold;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-ide mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="ti ti-brand-cpp me-2"></i> CYBER C++ IDE
            </a>
            <div class="d-flex align-items-center">
                <span class="me-2">THEMES:</span>
                <?php foreach ($themes as $name => $theme_item): ?>
                    <span class="theme-selector me-1"
                        style="background: <?= $theme_item['primary'] ?>;"
                        onclick="changeTheme('<?= $name ?>')"
                        title="<?= $theme_item['name'] ?>"></span>
                <?php endforeach; ?>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-ide mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="ti ti-files me-2"></i> PROJECT FILES</span>
                        <button class="btn btn-sm btn-ide" data-bs-toggle="modal" data-bs-target="#newFileModal">
                            <i class="ti ti-plus"></i>
                        </button>
                    </div>
                    <div class="list-group list-group-flush">
                        <?php foreach ($files as $filename => $content): ?>
                            <a href="?file=<?= urlencode($filename) ?>"
                                class="list-group-item list-group-item-action file-item <?= $filename === $current_file ? 'active-file' : '' ?>">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span><i class="ti ti-file-code me-2"></i> <?= htmlspecialchars($filename) ?></span>
                                    <?php if (count($files) > 1): ?>
                                        <button class="btn btn-sm btn-link p-0" style="color: var(--error-color);"
                                            onclick="event.stopPropagation(); deleteFile('<?= urlencode($filename) ?>')">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="card card-ide mb-4">
                    <div class="card-header">
                        <span><i class="ti ti-download me-2"></i> IMPORT/EXPORT</span>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button class="btn btn-ide mb-2" onclick="downloadFile()">
                                <i class="ti ti-download me-1"></i> DOWNLOAD FILE
                            </button>
                            <button class="btn btn-ide" onclick="document.getElementById('uploadFile').click()">
                                <i class="ti ti-upload me-1"></i> UPLOAD FILE
                                <input type="file" id="uploadFile" style="display: none;" accept=".cpp,.h,.hpp">
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card card-ide">
                    <div class="card-header">
                        <span><i class="ti ti-info-circle me-2"></i> ABOUT</span>
                    </div>
                    <div class="card-body">
                        <p class="small">
                            <strong>Cyber C++ IDE</strong> is a modern, browser-based C++ development environment with interactive terminal.
                        </p>
                        <p class="small mb-0">
                            <i class="ti ti-code me-1"></i> Supports C++17 standard
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="editor-container mb-4">
                    <textarea id="code-editor" name="code"><?= htmlspecialchars($files[$current_file]) ?></textarea>
                </div>

                <div class="d-flex justify-content-between mb-4">
                    <div>
                        <button id="compile-btn" class="btn btn-ide me-3 pulse-animation">
                            <i class="ti ti-player-play me-1"></i> COMPILE & RUN
                        </button>
                        <button id="format-btn" class="btn btn-ide me-3">
                            <i class="ti ti-code me-1"></i> FORMAT CODE
                        </button>
                        <button id="save-btn" class="btn btn-ide">
                            <i class="ti ti-device-floppy me-1"></i> SAVE FILE
                        </button>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="me-2"><?= strtoupper($theme['name']) ?> THEME</span>
                    </div>
                </div>

                <div class="terminal-container mb-3" id="output">
                    <div class="terminal-output"><?= $output ?></div>
                </div>

                <div id="input-container" style="display: <?= $needs_input ? 'block' : 'none' ?>;">
                    <div class="input-group">
                        <span class="input-group-text terminal-prompt">></span>
                        <input type="text" id="program-input" class="terminal-input form-control"
                            placeholder="Enter program input and press Enter...">
                        <button id="submit-input" class="btn btn-ide">
                            <i class="ti ti-send me-1"></i> SEND
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="newFileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="ti ti-file-plus me-1"></i> CREATE NEW FILE</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="newFileName" class="form-label">FILE NAME</label>
                        <input type="text" class="form-control" id="newFileName" placeholder="example.cpp">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                    <button type="button" class="btn btn-ide" onclick="createNewFile()">
                        <i class="ti ti-check me-1"></i> CREATE
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/clike/clike.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/addon/edit/matchbrackets.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/addon/edit/closebrackets.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/addon/hint/show-hint.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/addon/fold/foldcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/addon/fold/foldgutter.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/addon/fold/brace-fold.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/addon/fold/indent-fold.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/addon/fold/comment-fold.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        const editor = CodeMirror.fromTextArea(document.getElementById('code-editor'), {
            mode: 'text/x-c++src',
            theme: '<?= $theme['codemirror'] ?>',
            lineNumbers: true,
            indentUnit: 4,
            tabSize: 4,
            lineWrapping: true,
            autoCloseBrackets: true,
            matchBrackets: true,
            foldGutter: true,
            gutters: ["CodeMirror-linenumbers", "CodeMirror-foldgutter"],
            extraKeys: {
                'Ctrl-Space': 'autocomplete',
                'Ctrl-Enter': compileAndRun,
                'Ctrl-/': 'toggleComment',
                'F11': toggleFullscreen,
                'Ctrl-S': saveCode
            }
        });


        function changeTheme(theme) {
            window.location.href = `?theme=${theme}`;
        }


        function compileAndRun() {
            const code = editor.getValue();

            $('#output .terminal-output').html('<span class="text-primary">🔄 Compiling code...</span>');
            $('#input-container').hide();

            $.ajax({
                url: '',
                type: 'POST',
                data: {
                    code: code,
                    compile: 1
                },
                dataType: 'json',
                success: function(response) {
                    $('#output .terminal-output').html(response.output);

                    if (response.needs_input) {
                        $('#input-container').show();
                        $('#program-input').focus();
                    }


                    if (response.code) {
                        editor.setValue(response.code);
                    }


                    const terminal = document.getElementById('output');
                    terminal.scrollTop = terminal.scrollHeight;
                },
                error: function(xhr, status, error) {
                    $('#output .terminal-output').html('<span class="error-message">❌ Error: ' + error + '</span>');
                }
            });
        }


        function submitInput() {
            const input = $('#program-input').val();

            $('#output .terminal-output').append('<div class="terminal-prompt">> ' + input + '</div>');
            $('#program-input').val('');

            $.ajax({
                url: '',
                type: 'POST',
                data: {
                    program_input: input
                },
                dataType: 'json',
                success: function(response) {
                    $('#output .terminal-output').append(response.output);
                    $('#input-container').hide();


                    const terminal = document.getElementById('output');
                    terminal.scrollTop = terminal.scrollHeight;
                },
                error: function(xhr, status, error) {
                    $('#output .terminal-output').append('<div class="terminal-error">❌ Error: ' + error + '</div>');
                }
            });
        }


        function createNewFile() {
            const fileName = $('#newFileName').val();
            if (fileName) {
                window.location.href = `?new_file=1&new_file_name=${encodeURIComponent(fileName)}`;
                $('#newFileModal').modal('hide');
            }
        }


        function deleteFile(filename) {
            if (confirm(`Are you sure you want to delete ${filename}?`)) {
                window.location.href = `?delete_file=${filename}`;
            }
        }


        function downloadFile() {
            const code = editor.getValue();
            const blob = new Blob([code], {
                type: 'text/plain'
            });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = '<?= $current_file ?>';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);

            showToast('File downloaded successfully!', 'success');
        }


        function saveCode() {
            const code = editor.getValue();

            $.ajax({
                url: '',
                type: 'POST',
                data: {
                    code: code
                },
                success: function() {
                    showToast('Code saved successfully!', 'success');
                },
                error: function(xhr, status, error) {
                    showToast('Error saving code: ' + error, 'error');
                }
            });

            return false;
        }


        document.getElementById('uploadFile').addEventListener('change', function() {
            if (this.files.length > 0) {
                const file = this.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    editor.setValue(e.target.result);
                    showToast('File uploaded successfully!', 'success');
                };

                reader.readAsText(file);
            }
        });


        $('#compile-btn').click(compileAndRun);

        $('#format-btn').click(function() {
            const code = editor.getValue();

            $.ajax({
                url: '',
                type: 'POST',
                data: {
                    format: 1,
                    code: code
                },
                dataType: 'json',
                success: function(response) {
                    $('#output .terminal-output').html(response.output);
                    if (response.code) {
                        editor.setValue(response.code);
                    }
                    showToast('Code formatted successfully!', 'success');
                },
                error: function(xhr, status, error) {
                    $('#output .terminal-output').html('<span class="error-message">❌ Formatting error: ' + error + '</span>');
                }
            });
        });

        $('#save-btn').click(saveCode);

        $('#submit-input').click(submitInput);
        $('#program-input').keypress(function(e) {
            if (e.which === 13) {
                submitInput();
                return false;
            }
        });


        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `toast show position-fixed bottom-0 end-0 m-3`;
            toast.style.zIndex = '9999';
            toast.innerHTML = `
                <div class="toast-header" style="background-color: var(--${type}-color); color: #121212;">
                    <strong class="me-auto">${type.charAt(0).toUpperCase() + type.slice(1)}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body" style="background-color: var(--editor-bg);">
                    ${message}
                </div>
            `;

            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }


        function toggleFullscreen() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen().catch(err => {
                    console.error(`Error attempting to enable fullscreen: ${err.message}`);
                });
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        }


        editor.focus();


        document.title = `<?= $current_file ?> - Cyber C++ IDE`;
    </script>
</body>

</html>