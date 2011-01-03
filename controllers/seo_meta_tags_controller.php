<?php
class SeoMetaTagsController extends SeoAppController {

	var $name = 'SeoMetaTags';

	function admin_index() {
		$this->SeoMetaTag->recursive = 0;
		$this->set('seoMetaTags', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid seo meta tag', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seoMetaTag', $this->SeoMetaTag->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->SeoMetaTag->create();
			if ($this->SeoMetaTag->save($this->data)) {
				$this->Session->setFlash(__('The seo meta tag has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo meta tag could not be saved. Please, try again.', true));
			}
		}
		$seoUris = $this->SeoMetaTag->SeoUri->find('list');
		$this->set(compact('seoUris'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid seo meta tag', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SeoMetaTag->save($this->data)) {
				$this->Session->setFlash(__('The seo meta tag has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo meta tag could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SeoMetaTag->read(null, $id);
		}
		$seoUris = $this->SeoMetaTag->SeoUri->find('list');
		$this->set(compact('seoUris'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for seo meta tag', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SeoMetaTag->delete($id)) {
			$this->Session->setFlash(__('Seo meta tag deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Seo meta tag was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>