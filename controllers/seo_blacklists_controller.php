<?php
class SeoBlacklistsController extends SeoAppController {

	var $name = 'SeoBlacklists';
	var $helpers = array('Time');
	
	function beforeFilter(){
		parent::beforeFilter();
		if(isset($this->Auth)){
			$this->Auth->allow('banned');
		}
	}
	
	/**
		* Banned action
		*/
	function banned(){
		$this->layout = 'banned';
	}

	/**
		* Admin actions
		*/
	function admin_index() {
		$this->SeoBlacklist->recursive = 0;
		$this->set('seoBlacklists', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid seo blacklist', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seoBlacklist', $this->SeoBlacklist->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->SeoBlacklist->create();
			if ($this->SeoBlacklist->save($this->data)) {
				$this->Session->setFlash(__('The seo blacklist has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo blacklist could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid seo blacklist', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SeoBlacklist->save($this->data)) {
				$this->Session->setFlash(__('The seo blacklist has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo blacklist could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SeoBlacklist->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for seo blacklist', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SeoBlacklist->delete($id)) {
			$this->Session->setFlash(__('Seo blacklist deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Seo blacklist was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>