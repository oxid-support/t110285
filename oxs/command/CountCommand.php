<?php

declare(strict_types = 1);

namespace OxidSupport\Command;

use OxidEsales\EshopCommunity\Internal\Framework\Console\AbstractShopAwareCommand;
use OxidSupport\Command\Counter;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CountCommand extends AbstractShopAwareCommand
{   
    const MESSAGE = 'There are %s available products in the shop.';
    private Counter $counterService;

    public function __construct(Counter $counterService)
    {
        parent::__construct();

        $this->counterService = $counterService;
    }

    protected function configure()
    {
        $this
            ->setName('oxs:product-counter:count')
            ->setDescription('Counts all available products in the shop.')
            ->setHelp('This command counts all available products in the shop and simply outputs it on the command line.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(sprintf($this::MESSAGE, $this->counterService->count()));

        return 0;
    }
}