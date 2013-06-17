<?php
class SeoRedirectsController extends SeoAppController {

	var $name = 'SeoRedirects';
	var $helpers = array('Time');
	
	function admin_index($filter = null) {
		if(!empty($this->data)){
			$filter = $this->data['SeoRedirect']['filter'];
		}
		$conditions = $this->SeoRedirect->generateFilterConditions($filter);
		$this->set('seoRedirects',$this->paginate($conditions));
		$this->set('filter', $filter);
	}
	
	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid seo redirect'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seoRedirect', $this->SeoRedirect->read(null, $id));
		$this->set('id', $id);
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->SeoRedirect->clear();
			if ($this->SeoRedirect->save($this->data)) {
				$this->Session->setFlash(__('The seo redirect has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo redirect could not be saved. Please, try again.'));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid seo redirect'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SeoRedirect->save($this->data)) {
				$this->Session->setFlash(__('The seo redirect has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo redirect could not be saved. Please, try again.'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SeoRedirect->read(null, $id);
		}
		$this->set('id', $id);
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for seo redirect'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SeoRedirect->delete($id)) {
			$this->Session->setFlash(__('Seo redirect deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Seo redirect was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
?>