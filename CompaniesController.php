<?php

class CompaniesController extends AppController {
	public $helpers = array('Html', 'Form');
	public $layout = 'default';

	public function index() {
		$this->set('title_for_layout', '企業一覧');
		$this->paginate = array(
			'limit' => 20,
			'sort' => 'id',
			'direction' => 'desc');
		$this->set('company', $this->paginate());
	}

	public function add() {
		$this->set('title_for_layout', '新規登録');
		if ($this->request->is('post')) {
			if ($this->Company->save($this->request->data)) {
				$this->Session->setFlash('登録しました。');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('登録出来ませんでした。');
			}
		}
	}

	public function edit($id = null) {
		$this->set('title_for_layout', '編集画面');
		$this->Company->id = $id;
		$this->set('company', $this->Company->read('name'));
		if ($this->request->is('get')) {
			$this->request->data = $this->Company->read();
		} else {
			if ($this->Company->save($this->request->data)) {
				$this->Session->setFlash('保存しました。');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('保存できませんでした。');
			}
		}
	}

	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Company->delete($id)) {
			$this->Session->setFlash('削除しました。');
			$this->redirect(array('action'=>'index'));
		}
	}
}
