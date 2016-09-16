<?php
/**
 * @link    https://github.com/old-town/workflow-admin
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\ZF2\Admin\WorkflowConfig;


use OldTown\Workflow\Loader\ArrayWorkflowFactory;


/**
 * Class ListRegisteredWorkflowBuilder
 *
 * @package OldTown\Workflow\ZF2\Admin\WorkflowConfig
 */
class ListRegisteredWorkflowBuilder
{
    /**
     * Подготавливает набор страниц на которых можно просмотреть workflow
     *
     * @param array $appConfig
     *
     * @return RegisteredWorkflow[]
     */
    public function build(array $appConfig)
    {

        $listRegisteredWorkflow = [];

        $wfManagersConfig = [];
        $wfConfigurations = [];
        if (array_key_exists('workflow_zf2', $appConfig) && is_array($appConfig['workflow_zf2'])) {
            $wfConfig = $appConfig['workflow_zf2'];
            if (array_key_exists('managers', $wfConfig) && is_array($wfConfig['managers'])) {
                $wfManagersConfig = $wfConfig['managers'];
            }
            if (array_key_exists('configurations', $wfConfig) && is_array($wfConfig['configurations'])) {
                $wfConfigurations = $wfConfig['configurations'];
            }
        }
        foreach ($wfManagersConfig as $wfManagerName => $wfManagerConfig) {
            if (is_array($wfManagerConfig) && array_key_exists('configuration', $wfManagerConfig) && is_string($wfManagerConfig['configuration'])) {
                $configurationName = $wfManagerConfig['configuration'];
                if (array_key_exists($configurationName, $wfConfigurations) && is_array($wfConfigurations[$configurationName])) {
                    $listWorkflows = $this->buildListWorkflows($wfConfigurations[$configurationName]);

                    foreach ($listWorkflows as $workflowName) {
                        $listRegisteredWorkflow[]= new RegisteredWorkflow($workflowName, $wfManagerName);
                    }
                }
            }
        }

        return $listRegisteredWorkflow;
    }

    /**
     * Возвращает список workflow
     *
     * @param array $workflowConfigurations
     *
     * @return array
     */
    public function buildListWorkflows(array $workflowConfigurations)
    {
        $listWorkflows = [];
        if (array_key_exists('factory', $workflowConfigurations) && is_array($workflowConfigurations['factory'])) {
            $factoryConfig = $workflowConfigurations['factory'];
            $isArrayWorkflowFactory = array_key_exists('name', $factoryConfig) && ArrayWorkflowFactory::class === $factoryConfig['name'];
            if ($isArrayWorkflowFactory && array_key_exists('options', $factoryConfig) && is_array($factoryConfig['options'])) {
                $factoryOptions = $factoryConfig['options'];
                if (array_key_exists('workflows', $factoryOptions) && is_array($factoryOptions['workflows'])) {
                    $listWorkflows = array_keys($factoryOptions['workflows']);
                }
            }
        }

        return $listWorkflows;
    }
}
