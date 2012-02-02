<?php
class SeoCanonicalsController extends SeoAppController {



	function admin_index($filter = null) {
		if(!empty($this->request->data)){
			$filter = $this->request->data['SeoCanonical']['filter'];
		}
		$conditions = $this->SeoCanonical->generateFilterConditions($filter);
		$this->set('seoCanonicals',$this->paginate($conditions));
		$this->set('filter', $filter);
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid seo canonical'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seoCanonical', $this->SeoCanonical->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->request->data)) {
			$this->SeoCanonical->create();
			if ($this->SeoCanonical->save($this->request->data)) {
				$this->Session->setFlash(__('The seo canonical has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo canonical could not be saved. Please, try again.'));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid seo canonical'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->SeoCanonical->save($this->request->data)) {
				$this->Session->setFlash(__('The seo canonical has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo canonical could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->SeoCanonical->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for seo canonical'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SeoCanonical->delete($id)) {
			$this->Session->setFlash(__('Seo canonical deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Seo canonical was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
