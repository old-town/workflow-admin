<?php
/**
 * @link    https://github.com/old-town/workflow-admin
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\ZF2\Admin\Controller;

use OldTown\Workflow\ZF2\Admin\WorkflowConfig\RegisteredWorkflow;
use Zend\Mvc\Controller\AbstractActionController;


/**
 * Class WfController
 *
 * @package OldTown\Workflow\ZF2\Admin\Controller
 */
class WfController extends AbstractActionController
{
    /**
     * Список workflows
     *
     * @var RegisteredWorkflow[]
     */
    private $listWorkflows = [];

    /**
     * Список workflows
     *
     * @return RegisteredWorkflow[]
     */
    public function getListWorkflows()
    {
        return $this->listWorkflows;
    }

    /**
     * Устанавливает список workflows
     *
     * @param array $listWorkflows
     *
     * @return $this
     */
    public function setListWorkflows(array $listWorkflows = [])
    {
        $this->listWorkflows = $listWorkflows;

        return $this;
    }


    /**
     * Действие по умолчанию
     *
     * @throws \Zend\Navigation\Exception\InvalidArgumentException
     */
    public function workflowListAction()
    {

        return [
            'listWorkflows' => $this->getListWorkflows()
        ];
    }
}
