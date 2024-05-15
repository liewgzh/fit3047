<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Seminars Controller
 *
 * @property \App\Model\Table\SeminarsTable $Seminars
 */
class SeminarsController extends AppController
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions(['index', 'view']); // Assuming 'index' and 'view' are public
    }

    /**
     * Index method
     *
     * Renders a list of all seminars.
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $seminars = $this->Seminars->find()->all();
        $this->set(compact('seminars'));
    }

    /**
     * View method
     *
     * Displays a single seminar based on its ID.
     *
     * @param string|null $id Seminar id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $seminar = $this->Seminars->get($id);
        $this->set(compact('seminar'));
    }

    /**
     * Add method
     *
     * Handles creation of a new seminar.
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');

        // Only allow admins to add seminars
        if ($user->role == 'Client') {
            $this->Flash->set(__('You are not authorized to add seminars.'));
            return $this->redirect(['action' => 'index']);
        }

        $seminar = $this->Seminars->newEmptyEntity();
        if ($this->request->is('post')) {
            $seminar = $this->Seminars->patchEntity($seminar, $this->request->getData());

            // Set current date and time for the uploaded video
            $seminar->upload_date = new \DateTime();

            // Check if there's a file and it's uploaded via HTTP POST
            $file = $this->request->getData('video_path');
            if (!empty($file) && is_uploaded_file($file->getStream()->getMetaData('uri'))) {
                $filename = $file->getClientFilename();

                $destination = WWW_ROOT . 'videos' . DS . $filename;
                if (move_uploaded_file($file->getStream()->getMetaData('uri'), $destination)) {
                    $seminar->video_path = 'videos/' . $filename; // Save relative path
                }
            }

            if ($this->Seminars->save($seminar)) {
                $this->Flash->success(__('Your seminar has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Unable to add your seminar.'));
            }
        }
        $this->set(compact('seminar'));
    }






    /**
     * Edit method
     *
     * Handles updating of a seminar.
     *
     * @param string|null $id Seminar id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');

        if ($user->role == 'Client') {
            $this->Flash->set(__('You are not authorized to edit seminars.'));
            return $this->redirect(['action' => 'index']);
        }

        $seminar = $this->Seminars->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $seminar = $this->Seminars->patchEntity($seminar, $this->request->getData());


            // Check if there's a file and it's uploaded via HTTP POST
            $file = $this->request->getData('video_path');
            if (!empty($file) && is_uploaded_file($file->getStream()->getMetaData('uri'))) {
                $filename = $file->getClientFilename();

                $destination = WWW_ROOT . 'videos' . DS . $filename;
                if (move_uploaded_file($file->getStream()->getMetaData('uri'), $destination)) {
                    $seminar->video_path = 'videos/' . $filename; // Save relative path
                }
            }
            if ($this->Seminars->save($seminar)) {
                $this->Flash->success(__('The seminar has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The seminar could not be updated. Please, try again.'));
        }
        $this->set(compact('seminar'));
    }

    /**
     * Delete method
     *
     * Handles deletion of a seminar.
     *
     * @param string|null $id Seminar id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');

        // Only allow admins to add seminars
        if ($user->role == 'Client') {
            $this->Flash->set(__('You are not authorized to delete seminars.'));
            return $this->redirect(['action' => 'index']);
        }

        $this->request->allowMethod(['post', 'delete']);
        $seminar = $this->Seminars->get($id);
        if ($this->Seminars->delete($seminar)) {
            $this->Flash->success(__('The seminar has been deleted.'));
        } else {
            $this->Flash->error(__('The seminar could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
