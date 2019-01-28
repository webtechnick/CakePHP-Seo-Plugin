<?php
App::uses('SeoAppController','Seo.Controller');
class SeoABTestsController extends SeoAppController {

	var $name = 'SeoABTests';
	var $helpers = array('Time');
	public $paginate = array(
		'order' => 'SeoABTest.created DESC'
	);
	
	function beforeFilter(){
		parent::beforeFilter();
		$this->set('slots', $this->SeoABTest->slots);
	}
	
	function admin_index($filter = null) {
		if(!empty($this->data)){
			$filter = $this->data['SeoABTest']['filter'];
		}
		$conditions = $this->SeoABTest->generateFilterConditions($filter);
		$this->set('seoABTests',$this->paginate($conditions));
		$this->set('filter', $filter);
	}
	
	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid seo AB Test'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seoABTest', $this->SeoABTest->read(null, $id));
		$this->set('id', $id);
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->SeoABTest->clear();
			if ($this->SeoABTest->save($this->data)) {
				$goodFlash = $this->_getViewObject()->elementExists('goodFlash') ? 'goodFlash' : 'default';
				$this->Session->setFlash(__('The seo AB Test has been saved'), $goodFlash);
				$this->redirect(array('action' => 'index'));
			} else {
				$badFlash = $this->_getViewObject()->elementExists('badFlash') ? 'badFlash' : 'default';
				$this->Session->setFlash(__('The seo AB Test could not be saved. Please, try again.'), $badFlash);
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$badFlash = $this->_getViewObject()->elementExists('badFlash') ? 'badFlash' : 'default';
			$this->Session->setFlash(__('Invalid seo AB Test'), $badFlash);
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SeoABTest->save($this->data)) {
				$goodFlash = $this->_getViewObject()->elementExists('goodFlash') ? 'goodFlash' : 'default';
				$this->Session->setFlash(__('The seo AB Test has been saved'), $goodFlash);
				$this->redirect(array('action' => 'index'));
			} else {
				$badFlash = $this->_getViewObject()->elementExists('badFlash') ? 'badFlash' : 'default';
				$this->Session->setFlash(__('The seo AB Test could not be saved. Please, try again.'), $badFlash);
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SeoABTest->read(null, $id);
		}
		$this->set('id', $id);
	}

	function admin_delete($id = null) {
		if (!$id) {
			$badFlash = $this->_getViewObject()->elementExists('badFlash') ? 'badFlash' : 'default';
			$this->Session->setFlash(__('Invalid id for seo AB Test'), $badFlash);
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SeoABTest->delete($id)) {
			$goodFlash = $this->_getViewObject()->elementExists('goodFlash') ? 'goodFlash' : 'default';
			$this->Session->setFlash(__('Seo AB Test deleted'), $goodFlash);
			$this->redirect(array('action'=>'index'));
		}
		$badFlash = $this->_getViewObject()->elementExists('badFlash') ? 'badFlash' : 'default';
		$this->Session->setFlash(__('Seo AB Test was not deleted'), $badFlash);
		$this->redirect(array('action' => 'index'));
	}
}
?>