<?php
class SeoCanonicalsController extends SeoAppController {

	var $name = 'SeoCanonicals';
	
	var $helpers = array('Time');

	function admin_index($filter = null) {
		if(!empty($this->data)){
			$filter = $this->data['SeoCanonical']['filter'];
		}
		$conditions = $this->SeoCanonical->generateFilterConditions($filter);
		$this->set('seoCanonicals',$this->paginate($conditions));
		$this->set('filter', $filter);
	}

	function admin_view($id = null) {
		if (!$id) {
			$badFlash = $this->_getViewObject()->elementExists('badFlash') ? 'badFlash' : 'default';
			$this->Session->setFlash(__('Invalid seo canonical'), $badFlash);
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seoCanonical', $this->SeoCanonical->read(null, $id));
		$this->set('id', $id);
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->SeoCanonical->clear();
			if ($this->SeoCanonical->save($this->data)) {
				$goodFlash = $this->_getViewObject()->elementExists('goodFlash') ? 'goodFlash' : 'default';
				$this->Session->setFlash(__('The seo canonical has been saved'), $goodFlash);
				$this->redirect(array('action' => 'index'));
			} else {
				$badFlash = $this->_getViewObject()->elementExists('badFlash') ? 'badFlash' : 'default';
				$this->Session->setFlash(__('The seo canonical could not be saved. Please, try again.'), $badFlash);
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$badFlash = $this->_getViewObject()->elementExists('badFlash') ? 'badFlash' : 'default';
			$this->Session->setFlash(__('Invalid seo canonical'), $badFlash);
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SeoCanonical->save($this->data)) {
				$goodFlash = $this->_getViewObject()->elementExists('goodFlash') ? 'goodFlash' : 'default';
				$this->Session->setFlash(__('The seo canonical has been saved'), $goodFlash);
				$this->redirect(array('action' => 'index'));
			} else {
				$badFlash = $this->_getViewObject()->elementExists('badFlash') ? 'badFlash' : 'default';
				$this->Session->setFlash(__('The seo canonical could not be saved. Please, try again.'), $badFlash);
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SeoCanonical->read(null, $id);
		}
		$this->set('id', $id);
	}

	function admin_delete($id = null) {
		if (!$id) {
			$badFlash = $this->_getViewObject()->elementExists('badFlash') ? 'badFlash' : 'default';
			$this->Session->setFlash(__('Invalid id for seo canonical'), $badFlash);
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SeoCanonical->delete($id)) {
			$goodFlash = $this->_getViewObject()->elementExists('goodFlash') ? 'goodFlash' : 'default';
			$this->Session->setFlash(__('Seo canonical deleted'), $goodFlash);
			$this->redirect(array('action'=>'index'));
		}
		$badFlash = $this->_getViewObject()->elementExists('badFlash') ? 'badFlash' : 'default';
		$this->Session->setFlash(__('Seo canonical was not deleted'), $badFlash);
		$this->redirect(array('action' => 'index'));
	}
}
