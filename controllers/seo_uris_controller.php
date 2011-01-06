<?php
class SeoUrisController extends SeoAppController {

	var $name = 'SeoUris';
	var $helpers = array('Time');
	
	function admin_index() {
		$this->SeoUri->recursive = 0;
		$this->set('seoUris', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid seo uri', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seoUri', $this->SeoUri->read(null, $id));
		$this->set('id', $id);
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->SeoUri->create();
			if ($this->SeoUri->save($this->data)) {
				$this->Session->setFlash(__('The seo uri has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo uri could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid seo uri', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SeoUri->save($this->data)) {
				$this->Session->setFlash(__('The seo uri has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo uri could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SeoUri->read(null, $id);
		}
		$this->set('id', $id);
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for seo uri', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SeoUri->delete($id)) {
			$this->Session->setFlash(__('Seo uri deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Seo uri was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_approve($id = null){
	  if(!$id) {
			$this->Session->setFlash(__('Invalid id for seo uri', true));
		}
		elseif($this->SeoUri->setApproved($id)) {
			$this->Session->setFlash(__('Seo Uri approved', true));
		}
		$this->redirect(array('admin' => true, 'action' => 'index'));
	}
}
?>