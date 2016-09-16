<?php
/**
 * @link    https://github.com/old-town/workflow-admin
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\ZF2\Admin;

return [
    'navigation' => [
        'workflowadmin' => [
            'home'         => [
                'label' => 'Home',
                'route' => 'workflow/admin',
            ],
            'workflowList' => [
                'label' => 'View Workflow',
                'route' => 'workflow/admin/workflowList',
                'pages' =>
                    [

                    ]
            ]
        ]
    ]
];
