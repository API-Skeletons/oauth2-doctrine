<?php

$modules = [
    'Laminas\ApiTools\ContentNegotiation',
    'Laminas\\ApiTools\\ApiProblem',
    'Laminas\\ApiTools\\MvcAuth',
    'Laminas\\ApiTools\\OAuth2',
    'ApiSkeletons\\OAuth2\\Doctrine',
    'Testing',
    'DoctrineModule',
    'DoctrineORMModule',
];

if (class_exists(Laminas\Router\Module::class)) {
    $modules[] = 'Laminas\\Router';
}

return [
    // This should be an array of module namespaces used in the application.
    'modules' => $modules,

    // These are various options for the listeners attached to the ModuleManager
    'module_listener_options' => [
        // This should be an array of paths in which modules reside.
        // If a string key is provided, the listener will consider that a module
        // namespace, the value of that key the specific path to that module's
        // Module class.
        'module_paths' => [
            __DIR__ . '/../../../../..',
            __DIR__ . '/../../../../../vendor',
            __DIR__ . '/module',
            'Testing' => __DIR__ . '/module/Testing',
        ],

        // An array of paths from which to glob configuration files after
        // modules are loaded. These effectively override configuration
        // provided by modules themselves. Paths may use GLOB_BRACE notation.
        'config_glob_paths' => [
            __DIR__ . '/orm-autoload/{,*.}{global,local}.php',
        ],

    ],
];
