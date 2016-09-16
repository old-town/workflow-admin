<?php
/**
 * @link    https://github.com/old-town/workflow-admin
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\ZF2\Admin;


use OldTown\Workflow\ZF2\Admin\Navigation\WorkflowListBuilder;
use OldTown\Workflow\ZF2\Admin\Navigation\WorkflowListBuilderFactory;
use OldTown\Workflow\ZF2\Admin\WorkflowConfig\ListRegisteredWorkflowBuilder;
use Webmozart\Assert\Assert;
use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Nnx\ModuleOptions\Module as ModuleOptions;
use Zend\ModuleManager\Feature\InitProviderInterface;
use Zend\ModuleManager\ModuleEvent;
use Zend\ModuleManager\ModuleManager;
use Zend\ModuleManager\ModuleManagerInterface;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\ServiceManager;


/**
 * Class Module
 *
 * @package Nnx\ModuleOptions
 */
class Module implements
    AutoloaderProviderInterface,
    ConfigProviderInterface,
    DependencyIndicatorInterface,
    BootstrapListenerInterface,
    InitProviderInterface
{
    /**
     * Имя секции в конфиги приложения отвечающей за настройки модуля
     *
     * @var string
     */
    const CONFIG_KEY = 'old-town-workflow-admin';

    /**
     * Имя модуля
     *
     * @var string
     */
    const MODULE_NAME = __NAMESPACE__;

    /**
     * @return array
     */
    public function getModuleDependencies()
    {
        return [
            ModuleOptions::MODULE_NAME,
            'ZF\\ApiProblem',
            'ZF\\Configuration',
            'ZF\\MvcAuth',
            'ZF\\Hal',
            'ZF\\ContentNegotiation',
            'ZF\\ContentValidation',
            'ZF\\Rest',

            'OldTown\Workflow\ZF2',
            'OldTown\Workflow\Doctrine\ZF2',
            'OldTown\Workflow\Doctrine\ZF2',
            'OldTown\Workflow\Designer\Client',
            'OldTown\Workflow\Designer\Server',
            'OldTown\Workflow\ZF2\Dispatch',
            'OldTown\Workflow\ZF2\Service',
            'OldTown\Workflow\ZF2\Toolkit',
        ];
    }

    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/',
                ],
            ],
        ];
    }

    /**
     * @param EventInterface $e
     *
     * @return array|void
     */
    public function onBootstrap(EventInterface $e)
    {
        Assert::isInstanceOf($e, MvcEvent::class);
        /** @var MvcEvent $e */

        $e->getApplication()->getEventManager()->attach(MvcEvent::EVENT_DISPATCH, [$this, 'initLayout']);

    }

    /**
     * @param MvcEvent $e
     */
    public function initLayout(MvcEvent $e)
    {
        $matchedRouteName = $e->getRouteMatch()->getMatchedRouteName();

        if ('workflow/designer/view' === $matchedRouteName || 0 === strpos($matchedRouteName, 'workflow/admin')) {
            $e->getViewModel()->setTemplate('old-town/admin/layout');
        }

    }

    /**
     * @param ModuleManagerInterface $manager
     *
     * @throws \Zend\ServiceManager\Exception\ServiceNotFoundException
     * @throws \Zend\ServiceManager\Exception\InvalidArgumentException
     * @throws \Zend\ServiceManager\Exception\InvalidServiceNameException
     */
    public function init(ModuleManagerInterface $manager)
    {
        Assert::isInstanceOf($manager, ModuleManager::class);
        /** @var ModuleManager $manager */

        $manager->getEventManager()->attach(ModuleEvent::EVENT_LOAD_MODULES_POST, [$this, 'initNavigation'], 50);

        $sm = $manager->getEvent()->getParam('ServiceManager');
        Assert::isInstanceOf($sm, ServiceManager::class);
        $this->initServices($sm);
    }

    /**
     * @param ServiceManager $sm
     *
     * @throws \Zend\ServiceManager\Exception\InvalidServiceNameException
     * @throws \Zend\ServiceManager\Exception\InvalidArgumentException
     */
    protected function initServices(ServiceManager $sm)
    {
        $sm->setInvokableClass(ListRegisteredWorkflowBuilder::class, ListRegisteredWorkflowBuilder::class);
        $sm->setFactory(WorkflowListBuilder::class, WorkflowListBuilderFactory::class);
    }

    /**
     * @param ModuleEvent $event
     *
     * @throws \Zend\ServiceManager\Exception\ServiceNotFoundException
     */
    public function initNavigation(ModuleEvent $event)
    {
        $configListener = $event->getConfigListener();
        $mergedConfig = $configListener->getMergedConfig(false);

        /** @var ServiceManager $sm */
        $sm = $event->getParam('ServiceManager');
        Assert::isInstanceOf($sm, ServiceManager::class);


        /** @var WorkflowListBuilder $workflowListBuilder */
        $workflowListBuilder = $sm->get(WorkflowListBuilder::class);
        Assert::isInstanceOf($workflowListBuilder, WorkflowListBuilder::class);

        $newMergedConfig = $workflowListBuilder->build($mergedConfig);
        $configListener->setMergedConfig($newMergedConfig);
    }



    /**
     * @inheritdoc
     *
     * @return array
     */
    public function getConfig()
    {
        return array_merge_recursive(
            include __DIR__ . '/config/module.config.php',
            include __DIR__ . '/config/serviceManager.config.php',
            include __DIR__ . '/config/router.config.php',
            include __DIR__ . '/config/controller.config.php',
            include __DIR__ . '/config/viewManager.config.php',
            include __DIR__ . '/config/navigation.config.php'

        );
    }

} 