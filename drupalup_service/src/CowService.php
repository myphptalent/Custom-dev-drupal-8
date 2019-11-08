<?php

namespace Drupal\drupalup_service;

/**
 * Cow service example of drupal8
 */ 


class CowService {
	
	private $sounds = ["loo", "moo"];
	
	/**
	 * Return a cow sounds.
	 */ 
	public function saySomething() {
		return $this->sounds[array_rand($this->sounds)];
		}
		
	}


?>
