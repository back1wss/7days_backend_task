<?php

namespace App\Command;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Domain\Post\PostManager;
use joshtronic\LoremIpsum;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GenerateSummaryPostCommand extends Command
{
    protected static $defaultName = 'app:generate-summary-post';
    protected static $defaultDescription = 'Run app:generate-summary-post';

    private LoremIpsum $loremIpsum;
    private PostManager $postManager;

    public function __construct(PostManager $postManager, LoremIpsum $loremIpsum, string $name = null)
    {
        parent::__construct($name);
        $this->loremIpsum = $loremIpsum;
        $this->postManager = $postManager;
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $title = sprintf('Summary %s', (new \DateTime())->format('Y-m-d'));
        $content = $this->loremIpsum->paragraphs(1);

        $this->postManager->addPost($title, $content);

        $output->writeln('A summary post has been generated.');

        return Command::SUCCESS;
    }
}
