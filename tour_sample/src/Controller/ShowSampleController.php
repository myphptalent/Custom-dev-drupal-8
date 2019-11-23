<?php

namespace Drupal\tour_sample\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class ShowSampleController.
 */
class ShowSampleController extends ControllerBase {

  /**
   * Showsample.
   *
   * @return string
   *   Return Hello string.
   */
  public function ShowSample() {
    return [
      '#theme' => 'tour_sample',
      '#samples' => 'This is a sample content from controller. Ref the Tour module.'
    ];
  }

}
