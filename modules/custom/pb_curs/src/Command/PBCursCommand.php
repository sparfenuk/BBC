<?php

namespace Drupal\pb_curs\Command;

use Drupal\pb_curs\Controller\PBCursController;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Drupal\Console\Core\Command\Command;

/**
 * Class PBCursCommand.
 *
 * Drupal\Console\Annotations\DrupalCommand (
 *     extension="pb_curs",
 *     extensionType="module"
 * )
 */
class PBCursCommand extends Command {

  /**
   * {@inheritdoc}
   */
  protected function configure() {
    $this
      ->setName('pb_curs:refresh')
      ->setDescription($this->trans('commands.pb_curs.refresh.description'));
  }

  /**
   * {@inheritdoc}
   */
  protected function execute(InputInterface $input, OutputInterface $output) {
    $message = \Drupal::service('pb_curs')->cursRefresh();
    $output->writeln($message);
  }

}
