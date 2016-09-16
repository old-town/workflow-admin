<?php
/**
 * @link    https://github.com/old-town/workflow-admin
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\ZF2\Admin\WorkflowConfig;

/**
 * Class RegisteredWorkflow
 *
 * @package OldTown\Workflow\ZF2\Admin\WorkflowConfig
 */
class RegisteredWorkflow
{
    /**
     * Имя workflow
     *
     * @var string
     */
    private $workflowName;

    /**
     * Имя менеджера workflow
     *
     * @var string
     */
    private $workflowManagerName;

    /**
     * RegisteredWorkflow constructor.
     *
     * @param string $workflowName
     * @param string $workflowManagerName
     */
    public function __construct($workflowName, $workflowManagerName)
    {
        $this->workflowName = $workflowName;
        $this->workflowManagerName = $workflowManagerName;
    }

    /**
     * Имя workflow
     *
     * @return string
     */
    public function getWorkflowName()
    {
        return $this->workflowName;
    }

    /**
     * Имя менеджера workflow
     *
     * @return string
     */
    public function getWorkflowManagerName()
    {
        return $this->workflowManagerName;
    }
}
