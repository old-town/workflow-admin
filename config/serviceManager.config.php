<?php
/**
 * @link    https://github.com/old-town/workflow-admin
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\ZF2\Admin;


use Zend\Navigation\Service\NavigationAbstractServiceFactory;



return [
    'service_manager' => [
        'invokables'         => [

        ],
        'factories'          => [

        ],
        'abstract_factories' => [
            NavigationAbstractServiceFactory::class => NavigationAbstractServiceFactory::class
        ]
    ],
];


