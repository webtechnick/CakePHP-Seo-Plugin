<?php
class SeoUrisController extends SeoAppController {

	var $name = 'SeoUris';
	var $helpers = array('Time');
	var $uses = array('Seo.SeoUri');
	
	private function clearAssociatesIfEmpty(){
		foreach($this->request->data['SeoMetaTag'] as $key => $metatag){
			if(isset($metatag['name']) && empty($metatag['name'])){
				unset($this->request->data['SeoMetaTag'][$key]);
			}
		}
		if(empty($this->request->data['SeoMetaTag'])){
			unset($this->request->data['SeoMetaTag']);
		}
		if(isset($this->request->data['SeoTitle']['title']) && empty($this->request->data['SeoTitle']['title'])){
			unset($this->request->data['SeoTitle']);
		}
	}
	
	function admin_index($filter = null) {
		if(!empty($this->request->data)){
			$filter = $this->request->data['SeoUri']['filter'];
		}
		$conditions = $this->SeoUri->generateFilterConditions($filter);
		$this->set('seoUris',$this->paginate($conditions));
		$this->set('filter', $filter);
	}
	
	function admin_urlencode($id = null){
		if($this->SeoUri->urlEncode($id)){
			$this->Session->setFlash("uri Successfully Url Encoded.");
		}
		else {
			$this->Session->setFlash("Erorr URL Encoding uri");
		}
		$this->redirect(array('action' => 'view', $id));
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid seo uri'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('seoUri', $this->SeoUri->findForViewById($id));
		$this->set('id', $id);
	}

	function admin_add() {
		if (!empty($this->request->data)) {
			$this->SeoUri->clear();
			$this->clearAssociatesIfEmpty();
			if ($this->SeoUri->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The seo uri has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo uri could not be saved. Please, try again.'));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid seo uri'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			$this->clearAssociatesIfEmpty();
			if ($this->SeoUri->save($this->request->data)) {
				$this->Session->setFlash(__('The seo uri has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The seo uri could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->SeoUri->findForViewById($id);
		}
		$this->set('status_codes', $this->SeoUri->SeoStatusCode->findCodeList());
		$this->set('id', $id);
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for seo uri'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SeoUri->delete($id)) {
			$this->Session->setFlash(__('Seo uri deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Seo uri was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_approve($id = null){
	  if(!$id) {
			$this->Session->setFlash(__('Invalid id for seo uri'));
		}
		elseif($this->SeoUri->setApproved($id)) {
			$this->Session->setFlash(__('Seo Uri approved'));
		}
		$this->redirect(array('admin' => true, 'action' => 'index'));
	}
}
?>
