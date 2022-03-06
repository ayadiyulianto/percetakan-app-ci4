<?php

namespace Config;

class IonAuth extends \IonAuth\Config\IonAuth
{
    public $siteTitle                = 'Example.com';       // Site Title, example.com
    public $adminEmail               = 'admin@example.com'; // Admin Email, admin@example.com
    public $defaultGroup             = 'operator';           // Default group, use name
    public $adminGroup               = 'admin';             // Default administrators group, use name
    public $identity                 = 'username';

    /**
     * Specifies the views that are used to display the
     * errors and messages.
     *
     * @var array
     */
    public $templates = [

        // templates for errors cf : https://bcit-ci.github.io/CodeIgniter4/libraries/validation.html#configuration
        'errors'   => [
            'list' => 'list',
        ],

        // templates for messages
        'messages' => [
            'list'   => 'auth\messages\list',
            'single' => 'auth\messages\single',
        ],
    ];
}
