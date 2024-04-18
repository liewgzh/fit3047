<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
    parent::beforeFilter($event);
    // Configure the login action to not require authentication, preventing
    // the infinite redirect loop issue
    $this->Authentication->addUnauthenticatedActions(['login', 'add','useradd']);
    

}

    public function login()
    {
    $this->Authorization->skipAuthorization();
    $this->request->allowMethod(['get', 'post']);
    $result = $this->Authentication->getResult();
    // regardless of POST or GET, redirect if user is logged in
    if ($result && $result->isValid()) {
        // redirect to /articles after login success
        $redirect = $this->request->getQuery('redirect', [
            'controller' => 'Pages',
            'action' => 'display',
        ]);
        return $this->redirect($redirect);
    }
    // display error if user submitted and authentication failed
    if ($this->request->is('post') && !$result->isValid()) {
        $this->Flash->error(__('Invalid username or password'));
    }
    }



    public function logout()
    {
        $this->Authorization->skipAuthorization();
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result && $result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    public function index()
    {   $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');

        // Check if the user is an admin
        if ($user->role !== 'Admin') {
            $this->Flash->error(__('You are not authorized to access this page.'));
            return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
        }
        

        $users = $this->Users->find();
        $this->set(compact('users'));
    }
    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

    
        $user = $this->Users->get($id, [
                'contain' => ['ClientAppointments', 'CounsellorAppointments']
            ]);
   
    
        $this->Authorization->authorize($user);
        $this->set(compact('user'));
        


    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {   
        
        $user = $this->Users->newEmptyEntity();
        try {
            $this->Authorization->authorize($user);
        } catch (\Authorization\Exception\ForbiddenException $e) {
            $this->Flash->error(__('You are not allowed to add this user.'));
            return $this->redirect([
                'controller' => 'Pages',
                'action' => 'display']);
        }

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function useradd()
    {   
        $this->Authorization->skipAuthorization();
        

        $user = $this->Users->newEmptyEntity();
        $user->role="Client";

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }


    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {    
        

        $user = $this->Users->get($id, contain: []);
        try {
            $this->Authorization->authorize($user);
        } catch (\Authorization\Exception\ForbiddenException $e) {
            $this->Flash->error(__('You are not allowed to add this user.'));
            return $this->redirect([
                'controller' => 'Pages',
                'action' => 'display']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        

        $user = $this->Users->get($id);
        try {
            $this->Authorization->authorize($user);
        } catch (\Authorization\Exception\ForbiddenException $e) {
            $this->Flash->error(__('You are not allowed to add this user.'));
            return $this->redirect([
                'controller' => 'Pages',
                'action' => 'display']);
        }

        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect([
            'controller' => 'Pages',
            'action' => 'index']);
    }
}
