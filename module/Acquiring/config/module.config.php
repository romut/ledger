<?php

namespace Acquiring;

return array(
    'controllers' => array(
        'invokables' => array(
            'Acquiring\Controller\FileLoad' => Controller\FileLoadController::class
        ),
    ),

    'console' => array(
        'router' => array(
            'routes' => array(
                'load' => array(
                    'options' => array(
                        'route' => 'acquiring-load',
                        'defaults' => array(
                            'controller' => 'Acquiring\Controller\FileLoad',
                            'action' => 'load_files',
                        ),
                    ),
                ),
            ),
        ),
    ),
);