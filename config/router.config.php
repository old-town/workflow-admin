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
                                'action' => 'index'
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'workflowList' => [
                                'type' => 'Segment',
                                'options' => [
                                    'route' => 'workflowList[/]',
                                    'defaults' => [
                                        'controller' => Controller\WfController::class,
                                        'action' => 'workflowList'
                                    ]
                                ],
                            ],
                            'workflowProcess' => [
                                'type' => 'Segment',
                                'options' => [
                                    'route' => 'workflowProcess[/]',
                                    'defaults' => [
                                        'controller' => Controller\WfProcessController::class,
                                        'action' => 'workflowProcess'
                                    ]
                                ],
                            ]
                        ]
                    ]
                ]
            ],
        ]
    ]
];