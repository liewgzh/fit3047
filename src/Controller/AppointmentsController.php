<?php
declare(strict_types=1);

namespace App\Controller;
use DateTime;
use DateInterval;
use Cake\Mailer\Mailer;
use Cake\View\JsonView;

/**
 * Appointments Controller
 *
 * @property \App\Model\Table\AppointmentsTable $Appointments
 */
class AppointmentsController extends AppController
{

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
    parent::beforeFilter($event);
    // Configure the login action to not require authentication, preventing
    // the infinite redirect loop issue
    $this->Authentication->addUnauthenticatedActions(['guestadd']);
    $this->Authentication->addUnauthenticatedActions(['calendar']);}
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {    $this->Authorization->skipAuthorization();

        $user = $this->request->getAttribute('identity');

        $query = $this->Appointments->find()
            ->contain(['Clients', 'Counsellors', 'Services']);
        $appointments = $this->Appointments->find()->contain(['Clients', 'Counsellors', 'Services']);

        if ($user->role === 'Client') {
            $query->where(['client_id' => $user->id]);
        } elseif ($user->role === 'Counsellor') {
            $query->where(['counsellor_id' => $user->id]);
        }

        $appointments = $query->all();

        $this->set(compact('appointments'));
    }

    public function calendar()
        {    $this->Authorization->skipAuthorization();

            $user = $this->request->getAttribute('identity');

            $query = $this->Appointments->find()
                ->contain(['Clients', 'Counsellors', 'Services']);
            $appointments = $this->Appointments->find()->contain(['Clients', 'Counsellors', 'Services']);

            $appointments = $query->all();

            $this->set(compact('appointments'));
        }

    public function viewClasses(): array
    {
        return [JsonView::class];
    }

    /**
     * View method
     *
     * @param string|null $id Appointment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
         $this->Authorization->skipAuthorization();

        $appointment = $this->Appointments->get($id, contain: ['Clients', 'Counsellors', 'Services']);

        $this->set(compact('appointment'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()//appointment/add
    {
        $this->Authorization->skipAuthorization();

        $appointment = $this->Appointments->newEmptyEntity();
        if ($this->request->is('post')) {
            $appointment = $this->Appointments->patchEntity($appointment, $this->request->getData());
            $service = $this->Appointments->Services->get($appointment->service_id);
            $startDateTimeStr = $appointment->appointment_date->format('Y-m-d') . ' ' . $appointment->start_time->format('H:i:s');
            $startDateTime = new \DateTime($startDateTimeStr);

            // Check if the appointment date is in the past
            $currentTime = new \DateTime();
            if ($startDateTime < $currentTime) {
                $this->Flash->set('Cannot add appointments in the past.');
            } else {
                $endTime = (clone $startDateTime)->add(new \DateInterval("PT{$service->duration}M"));
                $appointment->end_time = $endTime->format('H:i:s');
                $appointment->appointment_status="Scheduled";
                $appointment->payment_status="Unpaid";

                if ($this->Appointments->Conflicts($appointment)) {
                    $this->Flash->set('This appointment time is already booked. Please choose a different time.');
                } else {
                    if ($this->Appointments->save($appointment)) {
                        $this->Flash->success(__('The appointment has been saved.'));
                        $appointment = $this->Appointments->get($appointment->id, finder: 'all', contain: ['Clients']);
                        
                        
                    
                        $mailer = new Mailer('default');

                        $mailer
                        ->setEmailFormat('html')
                        ->setTo($appointment->client->email)
                        ->setSubject('Appointment Confirmation');

                       
                        $mailer
                        ->viewBuilder()
                        ->setTemplate('appointment_confirmation');

                        
                        $mailer
                        ->setViewVars([
                            'clientName' => $appointment->client->first_name, // Adjust based on your model
                            'appointmentDate' => $startDateTimeStr,
                            
                        ]);

                        $service = $this->Appointments->Services->get($appointment->service_id);
                        if ( $service->name == "consultation") {
                            $viewVars['zoomLink'] = 'Your Zoom Link Here';
                        }
                        
                        if (!$mailer->deliver()) {
                            $this->Flash->error('There was an issue sending the appointment confirmation email.');
                        }

                        return $this->redirect(['action' => 'index']);

                    }
                    $this->Flash->set('The appointment could not be saved. Please, try again.');
                }
            }
        }
        //$clients = $this->Appointments->Clients->find('list', limit: 200)->all();

        $user = $this->request->getAttribute('identity');
            $clients = [];
            if ($user->role === 'Client') {
                // If the logged-in user is a client, show only their name in the client dropdown
                $clients[$user->id] = $user->first_name . ' ' . $user->last_name;
            } else {
                // Otherwise, fetch all clients' data
                $clients = $this->Appointments->Clients->find('list', limit: 200)->all();
            }

        $counsellors = $this->Appointments->Counsellors->find('list', limit: 200)->all();
        $services = $this->Appointments->Services->find('list', limit: 200)->all();
        $this->set(compact('appointment', 'clients', 'counsellors', 'services'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Appointment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $appointment = $this->Appointments->get($id, contain: []);
        try {
            $this->Authorization->authorize($appointment);
        } catch (\Authorization\Exception\ForbiddenException $e) {
            $this->Flash->set('You are not allowed to edit this appointment.');
            return $this->redirect([
                'controller' => 'Pages',
                'action' => 'display']);
        }

        // Check the role of the logged-in user
        $user = $this->request->getAttribute('identity');

        if ($this->request->is(['patch', 'post', 'put'])) {
            // If the user is a counsellor or a client, prevent them from modifying the payment_status field
            if ($user->role === 'Client' || $user->role === 'Counsellor') {
                $appointment = $this->Appointments->patchEntity($appointment, $this->request->getData(), ['accessibleFields' => ['payment_status' => false]]);
            } else {
                $appointment = $this->Appointments->patchEntity($appointment, $this->request->getData());
            }
            if ($this->Appointments->save($appointment)) {
                $this->Flash->success(__('The appointment has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->set('The appointment could not be saved. Please, try again.');
        }
        $clients = $this->Appointments->Clients->find('list', limit: 200)->all();
        $counsellors = $this->Appointments->Counsellors->find('list', limit: 200)->all();
        $services = $this->Appointments->Services->find('list', limit: 200)->all();
        $this->set(compact('appointment', 'clients', 'counsellors', 'services'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Appointment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $appointment = $this->Appointments->get($id);
        try {
            $this->Authorization->authorize($appointment);
        } catch (\Authorization\Exception\ForbiddenException $e) {
            $this->Flash->set('You are not allowed to delete this appointment.');
            return $this->redirect([
                'controller' => 'Pages',
                'action' => 'display']);
        }

        if ($this->Appointments->delete($appointment)) {
            $this->Flash->success(__('The appointment has been deleted.'));
        } else {
            $this->Flash->set('The appointment could not be deleted. Please, try again.');
        }

        return $this->redirect(['action' => 'index']);
    }
    public function guestadd()//appointment/add
    {
        $this->Authorization->skipAuthorization();
        $appointment = $this->Appointments->newEmptyEntity();
        if ($this->request->is('post')) {
            $appointment = $this->Appointments->patchEntity($appointment, $this->request->getData());
            $service = $this->Appointments->Services->get($appointment->service_id);
            $startDateTimeStr = $appointment->appointment_date->format('Y-m-d') . ' ' . $appointment->start_time->format('H:i:s');
            $startDateTime = new \DateTime($startDateTimeStr);

            // Check if the appointment date is in the past
                        $currentTime = new \DateTime();
                        if ($startDateTime < $currentTime) {
                            $this->Flash->set('Cannot add appointments in the past.');
                        } else {

                            $endTime = (clone $startDateTime)->add(new \DateInterval("PT{$service->duration}M"));
                            $appointment->end_time = $endTime->format('H:i:s');
                            $appointment->appointment_status="Scheduled";
                            $appointment->payment_status="Unpaid";

                            if ($this->Appointments->Conflicts($appointment)) {
                                $this->Flash->set('This appointment time is already booked. Please choose a different time.');
                            } else {
                                if ($this->Appointments->save($appointment)) {
                                    $this->Flash->success(__('The appointment has been saved.'));
                                  
                                    $mailer = new Mailer('default');

                                    $mailer
                                    ->setEmailFormat('html')
                                    ->setTo($appointment->guest_email)
                                    ->setSubject('Appointment Confirmation');

                                    $mailer
                                    ->viewBuilder()
                                    ->setTemplate('appointment_confirmation');

                                    $mailer
                                    ->setViewVars([
                                        'clientName' => $appointment->guest_name, 
                                        'appointmentDate' => $startDateTimeStr,
                                        
                                    ]);

                                    $service = $this->Appointments->Services->get($appointment->service_id);
                                    if ( $service->name == "consultation") {
                                        $viewVars['zoomLink'] = 'Your Zoom Link Here';
                                    }else{
                                        $viewVars['zoomLink'] = null;
                                    }

                                    if (!$mailer->deliver()) {
                                        $this->Flash->error('There was an issue sending the appointment confirmation email.');
                                    }
                                    
                                    return $this->redirect(['action' => 'index']);
                                }
                                $this->Flash->set('The appointment could not be saved. Please, try again.');
                            }
                        }
        }

        $counsellors = $this->Appointments->Counsellors->find('list', limit: 200)->all();
        $services = $this->Appointments->Services->find('list', limit: 200)->all();
        $this->set(compact('appointment', 'counsellors', 'services'));
    }
}
