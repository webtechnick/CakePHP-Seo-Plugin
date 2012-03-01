<?php
class SeoBlacklistsController extends SeoAppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		if (isset($this->Auth)) {
			$this->Auth->allow('banned');
		}
	}
	
	/**
	* Banned action
	*/
	public function banned() {
		$this->layout = 'banned';
	}

	/**
	* Admin actions
	*/
	public function admin_index($filter = null) {
		if (!empty($this->request->data)) {
			$filter = $this->request->data['Location']['filter'];
		}
		$conditions = $this->SeoBlacklist->generateFilterConditions($filter);
		$this->set('seoBlacklists',$this->paginate($conditions));
		$this->set('filter', $filter);
	}

	public function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid seo blacklist'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seoBlacklist', $this->SeoBlacklist->read(null, $id));
	}

	public function admin_add() {
		if (!empty($this->request->data)) {
			$this->SeoBlacklist->create();
			if ($this->SeoBlacklist->save($this->request->data)) {
				$this->Session->setFlash(__('The seo blacklist has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo blacklist could not be saved. Please, try again.'));
			}
		}
	}

	public function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid seo blacklist'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->SeoBlacklist->save($this->request->data)) {
				$this->Session->setFlash(__('The seo blacklist has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo blacklist could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->SeoBlacklist->get($id);
		}
	}

	public function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for seo blacklist'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SeoBlacklist->delete($id)) {
			$this->Session->setFlash(__('Seo blacklist deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Seo blacklist was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}