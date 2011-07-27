<?php
class SeoCanonicalsController extends SeoAppController {

	var $name = 'SeoCanonicals';

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
			$this->Session->setFlash(__('Invalid seo canonical', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seoCanonical', $this->SeoCanonical->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->SeoCanonical->create();
			if ($this->SeoCanonical->save($this->data)) {
				$this->Session->setFlash(__('The seo canonical has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo canonical could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid seo canonical', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SeoCanonical->save($this->data)) {
				$this->Session->setFlash(__('The seo canonical has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo canonical could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SeoCanonical->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for seo canonical', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SeoCanonical->delete($id)) {
			$this->Session->setFlash(__('Seo canonical deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Seo canonical was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
