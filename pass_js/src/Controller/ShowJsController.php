<?php

namespace Drupal\pass_js\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class ShowJsController.
 */
class ShowJsController extends ControllerBase {

  /**
   * Showjs.
   *
   * @return string
   *   Return Hello string.
   */
  public function ShowJs() {
    /*return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: ShowJs')
    ];*/
    $build  = [];
    $build['content'] = [
		'#markup' => '<div class="js-var">'.$this->t('Our Js Page').'</div>',
    ];
    $build['#attached']['library'][] = 'pass_js/pass_js_show';
    $build['#attached']['drupalSettings']['pass_js']['title']  = $this->config('system.site')->get('name');
    return $build;
    
  }

}
