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
			$badFlash = $this->_getViewObject()->elementExists('badFlash') ? 'badFlash' : 'default';
			$this->Flash->set(__('Invalid seo title'), $badFlash);
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seoTitle', $this->SeoTitle->read(null, $id));
		$this->set('id', $id);
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->SeoTitle->clear();
			if ($this->SeoTitle->save($this->data)) {
				$goodFlash = $this->_getViewObject()->elementExists('goodFlash') ? 'goodFlash' : 'default';
				$this->Flash->set(__('The seo title has been saved'), $goodFlash);
				$this->redirect(array('action' => 'index'));
			} else {
				$badFlash = $this->_getViewObject()->elementExists('badFlash') ? 'badFlash' : 'default';
				$this->Flash->set(__('The seo title could not be saved. Please, try again.'), $badFlash);
			}
		}
		$seoUris = $this->SeoTitle->SeoUri->find('list');
		$this->set(compact('seoUris'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$badFlash = $this->_getViewObject()->elementExists('badFlash') ? 'badFlash' : 'default';
			$this->Flash->set(__('Invalid seo title'), $badFlash);
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SeoTitle->save($this->data)) {
				$goodFlash = $this->_getViewObject()->elementExists('goodFlash') ? 'goodFlash' : 'default';
				$this->Flash->set(__('The seo title has been saved'), $goodFlash);
				$this->redirect(array('action' => 'index'));
			} else {
				$badFlash = $this->_getViewObject()->elementExists('badFlash') ? 'badFlash' : 'default';
				$this->Flash->set(__('The seo title could not be saved. Please, try again.'), $badFlash);
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
			$badFlash = $this->_getViewObject()->elementExists('badFlash') ? 'badFlash' : 'default';
			$this->Flash->set(__('Invalid id for seo title'), $badFlash);
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SeoTitle->delete($id)) {
			$goodFlash = $this->_getViewObject()->elementExists('goodFlash') ? 'goodFlash' : 'default';
			$this->Flash->set(__('Seo title deleted'), $goodFlash);
			$this->redirect(array('action'=>'index'));
		}
		$badFlash = $this->_getViewObject()->elementExists('badFlash') ? 'badFlash' : 'default';
		$this->Flash->set(__('Seo title was not deleted'), $badFlash);
		$this->redirect(array('action' => 'index'));
	}
}
?>