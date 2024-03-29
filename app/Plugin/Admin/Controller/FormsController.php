<?php
App::uses('AdminAppController', 'Admin.Controller');
/**
 * Forms Controller
 *
 * @property Form $Form
 */
class FormsController extends AdminAppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Form->recursive = 0;
		$this->set('forms', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Form->id = $id;
		if (!$this->Form->exists()) {
			throw new NotFoundException(__('Invalid form'));
		}
		$this->set('form', $this->Form->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Form->create();
			if ($this->Form->save($this->request->data)) {
				$this->Session->setFlash(__('The form has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The form could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Form->id = $id;
		if (!$this->Form->exists()) {
			throw new NotFoundException(__('Invalid form'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Form->save($this->request->data)) {
				$this->Session->setFlash(__('The form has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The form could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Form->read(null, $id);
		}
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
		$this->Form->id = $id;
		if (!$this->Form->exists()) {
			throw new NotFoundException(__('Invalid form'));
		}
		if ($this->Form->delete()) {
			$this->Session->setFlash(__('Form deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Form was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
