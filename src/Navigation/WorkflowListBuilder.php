<?php
/**
 * @link    https://github.com/old-town/workflow-admin
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\ZF2\Admin\Navigation;
use OldTown\Workflow\ZF2\Admin\WorkflowConfig\ListRegisteredWorkflowBuilder;


/**
 * Class WorkflowListBuilder
 *
 * @package OldTown\Workflow\ZF2\Admin\Navigation
 */
class WorkflowListBuilder
{
    /**
     * @var ListRegisteredWorkflowBuilder
     */
    private $listRegisteredWorkflowBuilder;

    /**
     * WorkflowListBuilder constructor.
     *
     * @param ListRegisteredWorkflowBuilder $listRegisteredWorkflowBuilder
     */
    public function __construct(ListRegisteredWorkflowBuilder $listRegisteredWorkflowBuilder)
    {
        $this->listRegisteredWorkflowBuilder = $listRegisteredWorkflowBuilder;
    }

    /**
     * Подготавливает набор страниц на которых можно просмотреть workflow
     *
     * @param array $appConfig
     *
     * @return array
     */
    public function build(array $appConfig)
    {
        $listRegisteredWorkflow = $this->listRegisteredWorkflowBuilder->build($appConfig);

        foreach ($listRegisteredWorkflow as $registeredWorkflow) {
            $appConfig['navigation']['workflowadmin']['workflowList']['pages'][] = [
                'label' => sprintf(
                    'Manager "%s": workflow - %s',
                    $registeredWorkflow->getWorkflowManagerName(),
                    $registeredWorkflow->getWorkflowName()
                ),
                'route' => 'workflow/designer/view',
                'fragment' => sprintf(
                    'view-workflow/workflow-manager/%s/workflow-name/%s',
                    $registeredWorkflow->getWorkflowManagerName(),
                    $registeredWorkflow->getWorkflowName()
                )
            ];
        }

        return $appConfig;
    }
}
