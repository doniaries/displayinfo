<?php

return [
    'class_namespace' => 'App\\Livewire',
    'view_path' => resource_path('views/livewire'),
    'layout' => 'components.layouts.app',
    'lazy_placeholder' => null,
    'temporary_file_upload' => [
        'disk' => null,
        'rules' => ['required', 'file', 'max:50120'],
        'directory' => null,
        'middleware' => null,
        'preview_mimes' => null,
        'max_upload_time' => null,

    ],
    'manifest_path' => null,
    'back_button_cache' => false,
    'render_on_redirect' => false,

];
