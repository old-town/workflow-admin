<?php
/**
 * @link    https://github.com/old-town/workflow-admin
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\ZF2\Admin\Controller;

use Webmozart\Assert\Assert;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use OldTown\Workflow\ZF2\Admin\WorkflowConfig\ListRegisteredWorkflowBuilder;


/**
 * Class WfController
 *
 * @package OldTown\Workflow\ZF2\Admin\Controller
 */
class WfControllerFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return WfController
     * @throws \Zend\ServiceManager\Exception\ServiceNotFoundException
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $appServiceLocator = $serviceLocator instanceof AbstractPluginManager ? $serviceLocator->getServiceLocator() : $serviceLocator;

        $controller = new WfController();

        /** @var array $appConfig */
        $appConfig = $appServiceLocator->get('config');
        Assert::isArray($appConfig);

        /** @var ListRegisteredWorkflowBuilder $listRegisteredWorkflowBuilder */
        $listRegisteredWorkflowBuilder = $appServiceLocator->get(ListRegisteredWorkflowBuilder::class);
        Assert::isInstanceOf($listRegisteredWorkflowBuilder, ListRegisteredWorkflowBuilder::class);
        $listWorkflows = $listRegisteredWorkflowBuilder->build($appConfig);

        $controller->setListWorkflows($listWorkflows);

        return $controller;
    }

}
