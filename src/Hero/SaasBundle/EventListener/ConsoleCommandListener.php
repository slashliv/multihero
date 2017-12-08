<?php

namespace Hero\SaasBundle\EventListener;

use Hero\SaasBundle\DBAL\Connection\ConnectionWrapper;
use Hero\SaasBundle\Provider\TenantProviderInterface;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Input\InputOption;

class ConsoleCommandListener
{
    /**
     * @var TenantProviderInterface
     */
    private $tenantProvider;

    /**
     * @var ConnectionWrapper
     */
    private $connectionWrapper;

    public function __construct(ConnectionWrapper $connectionWrapper, TenantProviderInterface $tenantProvider)
    {
        $this->connectionWrapper = $connectionWrapper;
        $this->tenantProvider = $tenantProvider;
    }

    /**
     * @param ConsoleCommandEvent $event
     * @throws \Exception
     */
    public function onConsoleCommand(ConsoleCommandEvent $event)
    {
        $command = $event->getCommand();
        $input = $event->getInput();

        $command->getDefinition()->addOption(
            new InputOption('tenant', null, InputOption::VALUE_OPTIONAL, 'Tenant name', null)
        );

        if(!$command->getDefinition()->hasOption('em')) {
            $command->getDefinition()->addOption(
                new InputOption('em', null, InputOption::VALUE_OPTIONAL, 'The entity manager to use for this command')
            );
        }

        $input->bind($command->getDefinition());
        if(is_null($input->getOption('tenant'))) {
            $event->getOutput()->write('<error>shared:</error> ');

            return;
        }

        $tenantName = $input->getOption('tenant');

        $input->setOption('em', 'tenant');
        $command->getDefinition()->getOption('em')->setDefault('tenant');

        $tenant = $this->tenantProvider->get($tenantName);

        if($tenant === null) {
            throw new \RuntimeException(sprintf('Tenant identified as %s does not exists', $tenantName));
        }

        $this->connectionWrapper->switchConnection(
            $tenant->getServer(), $tenant->getDbName(), $tenant->getSchema(), false
        );

        $event->getOutput()->writeln(
            sprintf('<error>@%s:</error> ', $tenant->getId())
        );
    }
}