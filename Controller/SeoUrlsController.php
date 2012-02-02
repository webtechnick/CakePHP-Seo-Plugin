<?php
class SeoUrlsController extends SeoAppController {


	
	function admin_index($filter = null) {
		if(!empty($this->request->data)){
			$filter = $this->request->data['SeoUrl']['filter'];
		}
		$conditions = $this->SeoUrl->generateFilterConditions($filter);
		$this->set('seoUrls',$this->paginate($conditions));
		$this->set('filter', $filter);
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid seo url'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seoUri', $this->SeoUrl->findById($id));
		$this->set('id', $id);
	}

	function admin_add() {
		if (!empty($this->request->data)) {
			$this->SeoUrl->create();
			if ($this->SeoUrl->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The seo url has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo url could not be saved. Please, try again.'));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid seo url'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->SeoUrl->save($this->request->data)) {
				$this->Session->setFlash(__('The seo url has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo url could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->SeoUrl->findForViewById($id);
		}
		$this->set('status_codes', $this->SeoUrl->SeoStatusCode->findCodeList());
		$this->set('id', $id);
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for seo url'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SeoUrl->delete($id)) {
			$this->Session->setFlash(__('Seo url deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Seo url was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_approve($id = null){
	  if(!$id) {
			$this->Session->setFlash(__('Invalid id for seo url'));
		}
		elseif($this->SeoUrl->setApproved($id)) {
			$this->Session->setFlash(__('Seo Uri approved'));
		}
		$this->redirect(array('admin' => true, 'action' => 'index'));
	}

}
