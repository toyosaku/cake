<?php

class ProjectsController extends AppController {

	public $helpers = array('Html', 'Form');

	public function index() {
		$this->set('title_for_layout', '案件一覧');
		$this->paginate = array(
			'limit' => 20,
			'sort' => 'modified',
			'direction' => 'desc'
			);
		$this->set('projects', $this->paginate());
	}

	public function add() {
		$this->set('title_for_layout', '新規登録');
		if ($this->request->is('post')) {
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash('Success!');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('failed!');
			}
		}
	}

	public function edit($id = null) {
		$this->set('title_for_layout', '編集画面');
		$this->Project->id = $id;
		$this->set('project', $this->Project->read('name'));
		if ($this->request->is('get')) {
			$this->request->data = $this->Project->read();
		} else {
			if ($this->Project->save($this->request->data)) {
				$this->Session->setFlash('保存しました');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('failed!');
			} 

		}
	}

	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Project->delete($id)) {
			$this->Session->setFlash('Deleted!');
			$this->redirect(array('action'=>'index'));
		}
	}
}
