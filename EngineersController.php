<?php

class EngineersController extends AppController {
	public $helper = array('Html', 'Form');

	public function index() {
		$this->set('title_for_layout', 'エンジニア一覧');
		$this->paginate = array(
			'limit' => 20,
			'sort' => 'id',
			'direction' => 'desc');
		$this->set('engineers', $this->paginate());
	}

	public function add() {
		$this->set('title_for_layout', '新規登録');
		if ($this->request->is('post')) {
			if ($this->Engineer->save($this->request->data)) {
				$this->Session->setFlash('登録しました。');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('登録できませんでした。');
			}
		}
	}

	public function edit($id = null) {
		$this->set('title_for_layout', '編集画面');
		$this->Engineer->id = $id;
		if ($this->request->is('get')) {
			$this->request->data = $this->Engineer->read();
		} else {
			if ($this->Engineer->save($this->request->data)) {
				$this->Session->setFlash('保存しました。');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('保存出来ませんでした。');
			}
		}
	}

	public function delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		if ($this->Engineer->delete($id)) {
			$this->Session->setFlash('削除しました。');
			$this->redirect(array('action'=>'index'));
		}
	}
}