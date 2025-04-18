<?php

// Получаем и валидируем 'topic'
$topic = $_GET['topic'] ?? '';
$topic = trim($topic);
if (!preg_match('/^[a-z0-9_\-]+$/', $topic)) {
    $topic = 'whatisinnosetup';
}

// Получаем и валидируем 'anchor'
$anchorRaw = $_GET['anchor'] ?? '';
$anchorRaw = trim($anchorRaw);
$anchor = '#' . $anchorRaw;
if (!preg_match('/^#[a-zA-Z0-9_\-.]+$/', $anchor)) {
    $anchor = '';
}

// Чтение файла
$text = file_get_contents('index.htm');
if ($text === false) {
    http_response_code(500);
    exit('Ошибка чтения файла index.htm');
}

// Замена ссылки
$link = htmlspecialchars("topic_$topic.htm$anchor", ENT_QUOTES | ENT_HTML5, 'UTF-8');
$text = str_replace('topic_whatisinnosetup.htm', $link, $text);

// Вывод
header('Content-Type: text/html; charset=UTF-8');
echo $text;