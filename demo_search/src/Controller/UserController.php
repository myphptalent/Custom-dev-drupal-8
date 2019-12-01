<?php

namespace Drupal\demo_search\Controller;

use Drupal\Core\Controller\ControllerBase;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class UserController.
 */
class UserController extends ControllerBase {

  /**
   * Display User.
   *
   * @return string
   *   Return Form.
   */
  public function DisplayUser() {
    
    $search_form = \Drupal::formBuilder()->getForm('Drupal\demo_search\Form\DemoSearchForm');
         
    return $search_form;
    
    
    
  }
  
  
   /**
   * SearchByUser.
   *
   * @return string
   *  
   */
  public function SearchByUser(Request $request) {
   $string = $request->query->get('q');
   $res = [];
	   if ($string) {
	    $database = \Drupal::database();
	    $query = $database->select('users', 'u');
		$query->join('users_field_data', 'ud', 'u.uid=ud.uid');
		$query->condition('u.uid', 0, '<>');
		$query->condition('ud.name', "%" . $database->escapeLike($string) . "%", 'LIKE');
		$query->fields('u', ['uid']);
		$query->fields('ud', ['name', 'mail']);
		$query->range(0, 50);
		$result = $query->execute();

	   foreach ($result as $record) {
		   $res[] = ['value'=>$record->name, 'label'=>$record->name];
		}
	}
   return new JsonResponse($res);
   
    
  }

}
