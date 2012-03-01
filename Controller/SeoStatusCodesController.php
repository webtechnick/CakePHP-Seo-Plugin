<?php
class SeoStatusCodesController extends SeoAppController {


	
	
	public function admin_index($filter = null) {
		if (!empty($this->request->data)) {
			$filter = $this->request->data['SeoStatusCode']['filter'];
		}
		$conditions = $this->SeoStatusCode->generateFilterConditions($filter);
		$this->set('seoStatusCodes',$this->paginate($conditions));
		$this->set('filter', $filter);
	}
	
	public function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid seo status code'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seoStatusCode', $this->SeoStatusCode->read(null, $id));
		$this->set('id', $id);
	}

	public function admin_add() {
		if (!empty($this->request->data)) {
			$this->SeoStatusCode->create();
			if ($this->SeoStatusCode->save($this->request->data)) {
				$this->Session->setFlash(__('The seo status code has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo status code could not be saved. Please, try again.'));
			}
		}
		$this->set('status_codes', $this->SeoStatusCode->findCodeList());
	}

	public function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid seo status code'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->SeoStatusCode->save($this->request->data)) {
				$this->Session->setFlash(__('The seo status code has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo status code could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->SeoStatusCode->get($id);
		}
		$this->set('status_codes', $this->SeoStatusCode->findCodeList());
		$this->set('id', $id);
	}

	public function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for seo status code'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SeoStatusCode->delete($id)) {
			$this->Session->setFlash(__('Seo status code deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Seo status code was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}