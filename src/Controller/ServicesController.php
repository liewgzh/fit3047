<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Services Controller
 *
 * @property \App\Model\Table\ServicesTable $Services
 */
class ServicesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {   $this->Authorization->skipAuthorization();

        $query = $this->Services->find();
        $services = $this->Services->find();

        $this->set(compact('services'));
    }

    /**
     * View method
     *
     * @param string|null $id Service id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {   $this->Authorization->skipAuthorization();

        $service = $this->Services->get($id, contain: ['Appointments']);
        $this->set(compact('service'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $service = $this->Services->newEmptyEntity();
        try {
            $this->Authorization->authorize($service);
        } catch (\Authorization\Exception\ForbiddenException $e) {
            $this->Flash->error('You are not allowed to add a service.');
            return $this->redirect(['action' => 'index']);
        }


        if ($this->request->is('post')) {
            $service = $this->Services->patchEntity($service, $this->request->getData());
            if ($this->Services->save($service)) {
                $this->Flash->success(__('The service has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('The service could not be saved. Please, try again.');
        }
        $this->set(compact('service'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Service id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $service = $this->Services->get($id, contain: []);
        try {
            $this->Authorization->authorize($service);
        } catch (\Authorization\Exception\ForbiddenException $e) {
            $this->Flash->error('You are not allowed to edit this service.');
            return $this->redirect(['action' => 'index']);
        }


        if ($this->request->is(['patch', 'post', 'put'])) {
            $service = $this->Services->patchEntity($service, $this->request->getData());
            if ($this->Services->save($service)) {
                $this->Flash->success(__('The service has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('The service could not be saved. Please, try again.');
        }
        $this->set(compact('service'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Service id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $this->request->allowMethod(['post', 'delete']);
        $service = $this->Services->get($id);
        try {
            $this->Authorization->authorize($service);
        } catch (\Authorization\Exception\ForbiddenException $e) {
            $this->Flash->error('You are not allowed to delete this service.');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->Services->delete($service)) {
            $this->Flash->success(__('The service has been deleted.'));
        } else {
            $this->Flash->error('The service could not be deleted. Please, try again.');
        }

        return $this->redirect(['action' => 'index']);
    }
}
