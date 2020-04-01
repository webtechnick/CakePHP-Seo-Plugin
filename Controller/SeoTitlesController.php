<?php
class SeoTitlesController extends SeoAppController {

	var $name = 'SeoTitles';
	var $helpers = array('Time');

	function admin_index($filter = null) {
		if(!empty($this->data)){
			$filter = $this->data['SeoTitle']['filter'];
		}
		$conditions = $this->SeoTitle->generateFilterConditions($filter);
		$this->set('seoTitles',$this->paginate($conditions));
		$this->set('filter', $filter);
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->badFlash(__('Invalid seo title'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seoTitle', $this->SeoTitle->read(null, $id));
		$this->set('id', $id);
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->SeoTitle->clear();
			if ($this->SeoTitle->save($this->data)) {
				$this->goodFlash(__('The seo title has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->badFlash(__('The seo title could not be saved. Please, try again.'));
			}
		}
		$seoUris = $this->SeoTitle->SeoUri->find('list');
		$this->set(compact('seoUris'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->badFlash(__('Invalid seo title'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SeoTitle->save($this->data)) {
				$this->goodFlash(__('The seo title has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->badFlash(__('The seo title could not be saved. Please, try again.'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SeoTitle->read(null, $id);
		}
		$seoUris = $this->SeoTitle->SeoUri->find('list');
		$this->set(compact('seoUris'));
		$this->set('id', $id);
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->badFlash(__('Invalid id for seo title'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SeoTitle->delete($id)) {
			$this->goodFlash(__('Seo title deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->badFlash(__('Seo title was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
?>