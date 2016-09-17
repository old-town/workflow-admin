<?php
/**
 * @link    https://github.com/old-town/workflow-admin
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\ZF2\Admin;

use OldTown\Workflow\ZF2\Admin\Controller;

return [
    'controllers' => [
        'invokables' => [
            Controller\AdminController::class => Controller\AdminController::class,
            Controller\WfProcessController::class => Controller\WfProcessController::class
        ],
        'factories' => [
            Controller\WfController::class => Controller\WfControllerFactory::class
        ]
    ]
];