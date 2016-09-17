<?php
/**
 * @link    https://github.com/old-town/workflow-admin
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\ZF2\Admin\WorkflowConfig;



/**
 * Class ListWorkflowProcessTemplateBuilder
 *
 * @package OldTown\Workflow\ZF2\Admin\WorkflowConfig
 */
class ListWorkflowProcessTemplateBuilder
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
        $result = [];


        $metadata = [];
        if (array_key_exists('workflow_zf2_toolkit', $appConfig) && is_array($appConfig['workflow_zf2_toolkit'])) {
            $wfToolkitConfig = $appConfig['workflow_zf2_toolkit'];
            if (array_key_exists('workflow_entry_to_object_metadata', $wfToolkitConfig) && is_array($wfToolkitConfig['workflow_entry_to_object_metadata'])) {
                $metadata = $wfToolkitConfig['workflow_entry_to_object_metadata'];
            }
        }


        foreach ($metadata as $item) {
            $isValid = true;

//            if () {
//
//            }


        }


        //die('test');

        //return $listRegisteredWorkflow;
        return $appConfig;
    }

}
