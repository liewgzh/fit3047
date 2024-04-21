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
        if ($user->role !== 'Admin') {
            $this->Flash->error(__('You are not authorized to add seminars.'));
            return $this->redirect(['action' => 'index']);
        }

        $seminar = $this->Seminars->newEmptyEntity();
        if ($this->request->is('post')) {
            $seminar = $this->Seminars->patchEntity($seminar, $this->request->getData());

            // Check if there's a file and it's uploaded via HTTP POST
            if (!empty($this->request->getData('video_path')['tmp_name']) && is_uploaded_file($this->request->getData('video_path')['tmp_name'])) {
                $file = $this->request->getData('video_path');
                $filePath = '/opt/homebrew/var/www/team007-app_fit3047/webroot/videos/' . $file['name'];
                $destination = WWW_ROOT . 'videos/' . $file['name']; // For move_uploaded_file()

                // Move the file to the destination path
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    $seminar->video_path = $filePath;
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

        $seminar = $this->Seminars->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $seminar = $this->Seminars->patchEntity($seminar, $this->request->getData());
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
