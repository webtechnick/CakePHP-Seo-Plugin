<?php
class SeoRedirectsController extends SeoAppController {

	var $name = 'SeoRedirects';

	function admin_index() {
		$this->SeoRedirect->recursive = 0;
		$this->set('seoRedirects', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid seo redirect', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seoRedirect', $this->SeoRedirect->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->SeoRedirect->create();
			if ($this->SeoRedirect->saveAll($this->data)) {
				$this->Session->setFlash(__('The seo redirect has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo redirect could not be saved. Please, try again.', true));
			}
		}
		$seoUris = $this->SeoRedirect->SeoUri->find('list');
		$this->set(compact('seoUris'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid seo redirect', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SeoRedirect->saveAll($this->data)) {
				$this->Session->setFlash(__('The seo redirect has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo redirect could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SeoRedirect->read(null, $id);
		}
		$seoUris = $this->SeoRedirect->SeoUri->find('list');
		$this->set(compact('seoUris'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for seo redirect', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SeoRedirect->delete($id)) {
			$this->Session->setFlash(__('Seo redirect deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Seo redirect was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>