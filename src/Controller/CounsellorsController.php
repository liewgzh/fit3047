<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Counsellors Controller
 *
 * @property \App\Model\Table\CounsellorsTable $Counsellors
 */
class CounsellorsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Counsellors->find();
        $counsellors = $this->paginate($query);

        $this->set(compact('counsellors'));
    }

    /**
     * View method
     *
     * @param string|null $id Counsellor id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $counsellor = $this->Counsellors->get($id, contain: ['Appointments']);
        $this->set(compact('counsellor'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $counsellor = $this->Counsellors->newEmptyEntity();
        if ($this->request->is('post')) {
            $counsellor = $this->Counsellors->patchEntity($counsellor, $this->request->getData());
            if ($this->Counsellors->save($counsellor)) {
                $this->Flash->success(__('The counsellor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The counsellor could not be saved. Please, try again.'));
        }
        $this->set(compact('counsellor'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Counsellor id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $counsellor = $this->Counsellors->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $counsellor = $this->Counsellors->patchEntity($counsellor, $this->request->getData());
            if ($this->Counsellors->save($counsellor)) {
                $this->Flash->success(__('The counsellor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The counsellor could not be saved. Please, try again.'));
        }
        $this->set(compact('counsellor'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Counsellor id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $counsellor = $this->Counsellors->get($id);
        if ($this->Counsellors->delete($counsellor)) {
            $this->Flash->success(__('The counsellor has been deleted.'));
        } else {
            $this->Flash->error(__('The counsellor could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
