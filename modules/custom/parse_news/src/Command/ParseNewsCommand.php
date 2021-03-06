<?php

namespace Drupal\parse_news\Command;

use Drupal\parse_news\ParseNewsService;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Drupal\Console\Core\Command\Command;

/**
 * Class ParseNewsCommand.
 *
 * Drupal\Console\Annotations\DrupalCommand (
 *     extension="parse_news",
 *     extensionType="module"
 * )
 */
class ParseNewsCommand extends Command {

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('parse_news:parse')
      ->setDescription('Starts parsing news form sites declared in parse news module.');
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    /** @var $parse ParseNewsService  */
   $parse = \Drupal::service('parse_news');
   $message = $parse->parseNews();
   $output->writeln($message);
  }

}
