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
			$this->badFlash(__('Invalid seo canonical'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seoCanonical', $this->SeoCanonical->read(null, $id));
		$this->set('id', $id);
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->SeoCanonical->clear();
			if ($this->SeoCanonical->save($this->data)) {
				$this->goodFlash(__('The seo canonical has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->badFlash(__('The seo canonical could not be saved. Please, try again.'));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->badFlash(__('Invalid seo canonical'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SeoCanonical->save($this->data)) {
				$this->goodFlash(__('The seo canonical has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->badFlash(__('The seo canonical could not be saved. Please, try again.'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SeoCanonical->read(null, $id);
		}
		$this->set('id', $id);
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->badFlash(__('Invalid id for seo canonical'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SeoCanonical->delete($id)) {
			$this->goodFlash(__('Seo canonical deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->badFlash(__('Seo canonical was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
