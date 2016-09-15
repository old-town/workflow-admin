<?php
/**
 * @link    https://github.com/old-town/workflow-admin
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\ZF2\Admin;

use OldTown\Workflow\ZF2\Admin\Controller;

return [
    'router' => [
        'routes' => [
            'workflow' => [
                'child_routes' => [
                    'admin' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => 'admin[/]',
                            'defaults' => [
                                'controller' => Controller\AdminController::class,
                                'action' => 'app'
                            ],
                            'may_terminate' => true
                        ],
                    ]
                ]
            ],
        ]
    ]
];