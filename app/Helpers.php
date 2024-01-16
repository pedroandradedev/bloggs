<?php

function site(string $param = null): string
{
    if ($param && !empty(SITE[$param])) {
        return SITE[$param];
    }

    return SITE["root"];
}

function asset(string $path, $time = true): string
{
    $file = SITE["root"] . "/assets/{$path}";
    $fileOnDir = dirname(__DIR__, 1) . "/assets/{$path}";
    if ($time && file_exists($fileOnDir)) {
        $file .= "?time=" . filemtime($fileOnDir);
    }
    return $file;
}

function ajax(array $values)
{
    echo json_encode($values);
}

function create_flash_message(string $name, string $message, string $type): void
{
    if (isset($_SESSION[FLASH][$name])) {
        unset($_SESSION[FLASH][$name]);
    }
    $_SESSION[FLASH][$name] = ['message' => $message, 'type' => $type];
}

function format_flash_message(array $flash_message): string
{
    $classes = match($flash_message['type']) {
        FLASH_ERROR => "bg-red-500/5 text-red-500 border-red-500",
        FLASH_WARNING => "bg-yellow-500/5 text-yellow-500 border-yellow-500",
        FLASH_INFO => "bg-cyan-500/5 text-cyan-500 border-cyan-500",
        FLASH_SUCCESS => "bg-green-500/5 text-green-500 border-green-500",
    };

    $icon = match($flash_message['type']) {
        FLASH_ERROR => "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"w-6 h-6 min-w-max\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><path d=\"m15 9-6 6\"/><path d=\"m9 9 6 6\"/></svg>",
        FLASH_WARNING => "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"w-6 h-6 min-w-max\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><line x1=\"12\" x2=\"12\" y1=\"8\" y2=\"12\"/><line x1=\"12\" x2=\"12.01\" y1=\"16\" y2=\"16\"/></svg>",
        FLASH_INFO => "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"w-6 h-6 min-w-max\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><path d=\"M12 16v-4\"/><path d=\"M12 8h.01\"/></svg>",
        FLASH_SUCCESS => "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"w-6 h-6 min-w-max\"><circle cx=\"12\" cy=\"12\" r=\"10\"/><path d=\"m9 12 2 2 4-4\"/></svg>",
    };

    return sprintf('<div class="mb-4 relative w-full rounded-lg border p-4 select-none flex items-center justify-between %s"><div class="flex items-start gap-2">%s<h5 class="mt-0.5 font-medium leading-5">%s</h5></div><svg onclick="this.parentElement.remove()" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 cursor-pointer"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></div>',
        $classes,
        $icon,
        $flash_message['message']
    );
}

function display_flash_message(string $name, bool $free)
{
    if (!isset($_SESSION[FLASH][$name])) {
        return;
    }
    $flash_message = $_SESSION[FLASH][$name];
    unset($_SESSION[FLASH][$name]);
    return $free ? $flash_message["message"] : format_flash_message($flash_message);
}

function display_all_flash_messages(): void
{
    if (!isset($_SESSION[FLASH])) {
        return;
    }
    $flash_messages = $_SESSION[FLASH];
    unset($_SESSION[FLASH]);
    foreach ($flash_messages as $flash_message) {
        echo format_flash_message($flash_message);
    }
}

function flash(string $name = '', string $message = '', string $type = '', bool $free = false)
{
    if ($name !== '' && $message !== '' && $type !== '') {
        create_flash_message($name, $message, $type);
    } elseif ($name !== '' && $message === '' && $type === '') {
        return display_flash_message($name, $free);
    } elseif ($name === '' && $message === '' && $type === '') {
        return display_all_flash_messages();
    }
}