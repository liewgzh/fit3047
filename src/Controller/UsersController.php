<?php
declare(strict_types=1);

namespace App\Controller;
use App\Model\Table\UsersTable;
use Cake\I18n\DateTime;
use Cake\Mailer\Mailer;
use Cake\Utility\Security;

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
    $this->Authentication->addUnauthenticatedActions(['login', 'add','useradd','sendTestEmail','forgetPassword','resetPassword','viewcounsellor']);


}



    // public function viewcounsellor($id = null)
    // {
    //     // Retrieve the counselor data including the bio
    //     $this->Authorization->skipAuthorization();
    //     $counselor = $this->Users->get($id, ['fields' => ['bio']]);

    //     // Pass the counselor data to the view
    //     $this->set(compact('counselor'));
    // }

    public function viewcounsellor($id = null)
    {
        // Retrieve the counselor data including the bio
        $this->Authorization->skipAuthorization();
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }




    public function login()
    {
        $this->Authorization->skipAuthorization();
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();

        // if user passes authentication, grant access to the system
        if ($result && $result->isValid()) {
            // set a fallback location in case user logged in without triggering 'unauthenticatedRedirect'
            $fallbackLocation = ['controller' => 'Pages', 'action' => 'display'];

            // and redirect user to the location they're trying to access
            return $this->redirect($this->Authentication->getLoginRedirect() ?? $fallbackLocation);
        }

        // display error if user submitted their credentials but authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error('Email address and/or Password is incorrect. Please try again. ');
        }
    }






        /**
     * Logout method
     *
     * @return \Cake\Http\Response|null|void
     */
    public function logout()
    {
        $this->Authorization->skipAuthorization();
        // We only need to log out a user when they're logged in
        $result = $this->Authentication->getResult();
        if ($result && $result->isValid()) {
            $this->Authentication->logout();

            $this->Flash->success('You have been logged out successfully. ');
        }

        // Otherwise just send them to the login page
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }


    public function index()
    {
        $this->Authorization->skipAuthorization();
        $user = $this->request->getAttribute('identity');

        // Check if the user is an admin
        if ($user->role !== 'Admin') {
            $this->Flash->set('You are not authorized to access this page.');
            return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
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


        try {
                $this->Authorization->authorize($user);
            } catch (\Authorization\Exception\ForbiddenException $e) {
                $this->Flash->set('You are not allowed to add this user.');
                return $this->redirect([
                    'controller' => 'Pages',
                    'action' => 'display']);
            }
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
            $this->Flash->error('You are not allowed to add this user.');
            return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
        }

        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $file = $data['image_path']; // Assuming image_path is the field name for the file upload

            unset($data['image_path']);
            $user = $this->Users->patchEntity($user, $data);

            if ($file instanceof \Psr\Http\Message\UploadedFileInterface && $file->getError() === UPLOAD_ERR_OK) {
                $filename = $file->getClientFilename();
                $destination = WWW_ROOT . 'user_images' . DS . $filename;

                // Test script to check file moving
                if (move_uploaded_file($file->getStream()->getMetaData('uri'), $destination)) {
                    echo "File is moved successfully.";
                    $user->image_path = 'user_images/' . $filename;
                } else {
                    echo "Failed to move the file.";
                    $this->Flash->error(__('Failed to move the uploaded file.'));
                }
            }

            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('The user could not be saved. Please, try again.');
            }
        }

        $this->set(compact('user'));
    }



    public function useradd()
    {
        $this->Authorization->skipAuthorization();
        $user = $this->Users->newEmptyEntity();
        $user->role = "Client";

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                // Login user automatically
                $this->Authentication->setIdentity($user);
                $this->Flash->success(__('The user has been saved.'));

                // Redirect to the general homepage as a logged-in user
                return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
            }

            $this->Flash->set('The user could not be saved. Please, try again.');
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
            $this->Flash->set('You are not allowed to edit this user.');
            return $this->redirect([
                'controller' => 'Pages',
                'action' => 'display']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            $image = $this->request->getData('image_path');
            if (!empty($image->getClientFilename()) && !$image->getError()) {
                $destination = WWW_ROOT . 'img' . DS . 'user_images' . DS . $image->getClientFilename();
                $image->moveTo($destination);
                $user->image_path = 'user_images/' . $image->getClientFilename();
            }

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->set('The user could not be saved. Please, try again.');
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
            $this->Flash->set('You are not allowed to delete this user.');
            return $this->redirect([
                'controller' => 'Pages',
                'action' => 'display']);
        }

        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->set('The user could not be deleted. Please, try again.');
        }

        return $this->redirect([
            'controller' => 'Pages',
            'action' => 'index']);
    }
        /**
     * Change Password method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function changePassword(?string $id = null)
    {
        $user = $this->Users->get($id, ['contain' => []]);
        try {
            $this->Authorization->authorize($user);
        } catch (\Authorization\Exception\ForbiddenException $e) {
            $this->Flash->error(__('You are not allowed to add this user.'));
            return $this->redirect([
                'controller' => 'Pages',
                'action' => 'display']);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            // Used a different validation set in Model/Table file to ensure both fields are filled
            $user = $this->Users->patchEntity($user, $this->request->getData(), ['validate' => 'resetPassword']);
            if ($this->Users->save($user)) {
                $this->Flash->success('The user has been saved.');

                return $this->redirect(['controller' => 'Pages', 'action' => 'display']);
            }
            $this->Flash->error('The user could not be saved. Please, try again.');
        }
        $this->set(compact('user'));
    }






    /**
     * Forget Password method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful email send, renders view otherwise.
     */
    public function forgetPassword()
    {
        $this->Authorization->skipAuthorization();
        if ($this->request->is('post')) {
            // Retrieve the user entity by provided email address
            $user = $this->Users->findByEmail($this->request->getData('email'))->first();
            if ($user) {
                // Set nonce and expiry date
                $user->nonce = Security::randomString(128);
                $user->nonce_expiry = new DateTime('7 days');
                if ($this->Users->save($user)) {
                    // Now let's send the password reset email
                    $mailer = new Mailer('default');

                    // email basic config
                    $mailer
                        ->setEmailFormat('both')
                        ->setTo($user->email)
                        ->setSubject('Reset your account password');

                    // select email template
                    $mailer
                        ->viewBuilder()
                        ->setTemplate('reset_password');

                    // transfer required view variables to email template
                    $mailer
                        ->setViewVars([
                            'first_name' => $user->first_name,
                            'last_name' => $user->last_name,
                            'nonce' => $user->nonce,
                            'email' => $user->email,
                        ]);

                    //Send email
                    if (!$mailer->deliver()) {
                        // Just in case something goes wrong when sending emails
                        $this->Flash->error('We have encountered an issue when sending you emails. Please try again. ');

                        return $this->render(); // Skip the rest of the controller and render the view
                    }
                } else {
                    // Just in case something goes wrong when saving nonce and expiry
                    $this->Flash->error('We are having issue to reset your password. Please try again. ');

                    return $this->render(); // Skip the rest of the controller and render the view
                }
            }

            /*
             * **This is a bit of a special design**
             * We don't tell the user if their account exists, or if the email has been sent,
             * because it may be used by someone with malicious intent. We only need to tell
             * the user that they'll get an email.
             */
            $this->Flash->success('Please check your inbox (or spam folder) for an email regarding how to reset your account password. ');

            return $this->redirect(['action' => 'login']);
        }
    }

       /**
     * Reset Password method
     *
     * @param string|null $nonce Reset password nonce
     * @return \Cake\Http\Response|null|void Redirects on successful password reset, renders view otherwise.
     */
    public function resetPassword(?string $nonce = null)
    {
        $this->Authorization->skipAuthorization();
        $user = $this->Users->findByNonce($nonce)->first();

        // If nonce cannot find the user, or nonce is expired, prompt for re-reset password
        if (!$user || $user->nonce_expiry < DateTime::now()) {
            $this->Flash->error('Your link is invalid or expired. Please try again.');

            return $this->redirect(['action' => 'forgetPassword']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            // Used a different validation set in Model/Table file to ensure both fields are filled
            $user = $this->Users->patchEntity($user, $this->request->getData(), ['validate' => 'resetPassword']);

            // Also clear the nonce-related fields on successful password resets.
            // This ensures that the reset link can't be used a second time.
            $user->nonce = null;
            $user->nonce_expiry = null;

            if ($this->Users->save($user)) {
                $this->Flash->success('Your password has been successfully reset. Please login with new password. ');

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error('The password cannot be reset. Please try again.');
        }

        $this->set(compact('user'));
    }




}
