<?php
class SeoRedirectsController extends SeoAppController {


	
	
	public function admin_index($filter = null) {
		if(!empty($this->request->data)){
			$filter = $this->request->data['SeoRedirect']['filter'];
		}
		$conditions = $this->SeoRedirect->generateFilterConditions($filter);
		$this->set('seoRedirects',$this->paginate($conditions));
		$this->set('filter', $filter);
	}
	
	public function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid seo redirect'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seoRedirect', $this->SeoRedirect->read(null, $id));
		$this->set('id', $id);
	}

	public function admin_add() {
		if(!empty($this->request->data)) {
			$this->SeoRedirect->create();
			if ($this->SeoRedirect->save($this->request->data)) {
				$this->Session->setFlash(__('The seo redirect has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo redirect could not be saved. Please, try again.'));
			}
		}
	}

	public function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid seo redirect'));
			$this->redirect(array('action' => 'index'));
		}
		if(!empty($this->request->data)) {
			if ($this->SeoRedirect->save($this->request->data)) {
				$this->Session->setFlash(__('The seo redirect has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo redirect could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->SeoRedirect->get($id);
		}
		$this->set('id', $id);
	}

	public function admin_delete($id = null) {
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