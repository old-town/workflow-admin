<?php
/**
 * @link    https://github.com/old-town/workflow-admin
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\ZF2\Admin;

/** @noinspection PhpIncludeInspection */
return [
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'template_map'        => array_merge(
            [
                'old-town/admin/index' => __DIR__ . '/../view/admin/index.phtml',
                'old-town/admin/layout' => __DIR__ . '/../view/layout/layout.phtml',
                'old-town/wf/workflow-list' => __DIR__ . '/../view/admin/workflow-list.phtml'
            ],
            file_exists(__DIR__ . '/../template_map.php') ? include __DIR__ . '/../template_map.php' : []
        )
    ],
];