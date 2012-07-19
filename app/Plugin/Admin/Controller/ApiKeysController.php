<?php
App::uses('AdminAppController', 'Admin.Controller');
/**
 * ApiKeys Controller
 *
 * @property ApiKey $ApiKey
 */
class ApiKeysController extends AdminAppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ApiKey->recursive = 0;
		$this->set('apiKeys', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->ApiKey->id = $id;
		if (!$this->ApiKey->exists()) {
			throw new NotFoundException(__('Invalid api key'));
		}
		$this->set('apiKey', $this->ApiKey->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ApiKey->create();
			if ($this->ApiKey->save($this->request->data)) {
				$this->Session->setFlash(__('The api key has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The api key could not be saved. Please, try again.'));
			}
		} else {
			App::uses('String', 'Utility');
			$this->request->data['ApiKey']['key'] = String::uuid();
		}
		$forms = $this->ApiKey->Form->find('list');
		$this->set(compact('forms'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->ApiKey->id = $id;
		if (!$this->ApiKey->exists()) {
			throw new NotFoundException(__('Invalid api key'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->ApiKey->save($this->request->data)) {
				$this->Session->setFlash(__('The api key has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The api key could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->ApiKey->read(null, $id);
		}
		$forms = $this->ApiKey->Form->find('list');
		$this->set(compact('forms'));
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->ApiKey->id = $id;
		if (!$this->ApiKey->exists()) {
			throw new NotFoundException(__('Invalid api key'));
		}
		if ($this->ApiKey->delete()) {
			$this->Session->setFlash(__('Api key deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Api key was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
