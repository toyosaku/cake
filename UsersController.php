<?php



class UsersController extends AppController {

	
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add');
    }
	public function login() {
		if ($this->request->is('post')) {
			if($this->Auth->login()) {
				$this->redirect($this->Auth->redirect(array('controller' => 'projects', 'action' => 'index')));
			} else {
				$this->Session->setFlash('ユーザ名かパスワードが違います', 'default', array(), 'auth');

			}
		}
	}

	public function logout() {
		$this->Session->setFlash('ログアウトしました');
		$this->redirect($this->Auth->logout(array('controller' => 'users', 'action' => 'login')));
	}

	public function add() {
		if ($this->request->is('post')) {
            	$this->User->create();
            	if ($this->User->save($this->request->data)) {
                	$this->Session->setFlash(__('登録しました'));
                	$this->redirect(array('action' => 'login'));
            } else {
                $this->Session->setFlash(__('登録できませんでした'));
            }
		}
	}

}