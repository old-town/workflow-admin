<?php
/**
 * @link    https://github.com/old-town/workflow-admin
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\ZF2\Admin\WorkflowConfig;


use OldTown\Workflow\ZF2\ServiceEngine\Workflow as WorkflowService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;



/**
 * Class ListWorkflowProcessTemplateBuilder
 *
 * @package OldTown\Workflow\ZF2\Admin\WorkflowConfig
 */
class ListWorkflowProcessTemplateBuilderFactory implements FactoryInterface
{
    /**
     * @inheritdoc
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return ListWorkflowProcessTemplateBuilder
     * @throws \Zend\ServiceManager\Exception\ServiceNotFoundException
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ListWorkflowProcessTemplateBuilder();
    }


}
