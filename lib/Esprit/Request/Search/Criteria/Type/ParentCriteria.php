<?php
namespace Esprit\Request\Search\Criteria\Type ;

use \Esprit\Request\Search\Criteria ;

/**
 * Generic class for all parent criterias, like Should/Or.
 */
abstract class ParentCriteria extends Criteria implements \Countable {

	/**
	 * Criteria children.
	 *
	 * @var array
	 */
	protected $_children = array() ;

	/**
	 * Constructor : takes directly the child queries in constructor or a data array.
	 */
	public function __construct() {
		$args = func_get_args() ;
		if ($args) {
			$this->_set($args) ;
		}
	}

	/**
	 * Add a subquery to this parent query.
	 *
	 * @param Criteria $child Child query to add
	 */
	public function add(Criteria $child) {
		$this->_children[] = $child ;
	}

	/**
	 * Counts the children (implements Countable)
	 *
	 * @return int Children count
	 */
	public function count() {
		return count($this->_children) ;
	}

	/**
	 * Smart set : look for criteria instances anywhere in data array.
	 *
	 * @param array $data Data to set
	 */
	protected function _set(array $data) {
		foreach($data as $child) {
			if ($child instanceof Criteria) {
				$this->add($child) ;
			} else {
				if (is_array($child) && is_numeric(key($child))) {
					$this->_set($child) ;
				} else {
					$this->data($child) ;
				}
			}
		}
	}

	/**
	 * Return children data.
	 *
	 * @return array Sub data
	 */
	protected function _subData() {
		$sub = [] ;
		foreach($this->_children as $child) {
			$sub[] = $child->data() ;
		}
		return $sub ;
	}
}
