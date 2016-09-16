<?php
/**
 * @link    https://github.com/old-town/workflow-admin
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\ZF2\Admin\Navigation;

use OldTown\Workflow\ZF2\Admin\WorkflowConfig\ListRegisteredWorkflowBuilder;
use Webmozart\Assert\Assert;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class WorkflowListBuilderFactory
 *
 * @package OldTown\Workflow\ZF2\Admin\Navigation
 */
class WorkflowListBuilderFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return WorkflowListBuilder
     * @throws \Zend\ServiceManager\Exception\ServiceNotFoundException
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @var ListRegisteredWorkflowBuilder $listRegisteredWorkflowBuilder */
        $listRegisteredWorkflowBuilder = $serviceLocator->get(ListRegisteredWorkflowBuilder::class);
        Assert::isInstanceOf($listRegisteredWorkflowBuilder, ListRegisteredWorkflowBuilder::class);

        return new WorkflowListBuilder($listRegisteredWorkflowBuilder);
    }

}
