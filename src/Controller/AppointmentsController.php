<?php
declare(strict_types=1);

namespace App\Controller;
use DateTime;
use DateInterval;

/**
 * Appointments Controller
 *
 * @property \App\Model\Table\AppointmentsTable $Appointments
 */
class AppointmentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Appointments->find()
            ->contain(['Clients', 'Counsellors', 'Services']);
        $appointments = $this->Appointments->find()->contain(['Clients', 'Counsellors', 'Services']);

        $this->set(compact('appointments'));
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
        $appointment = $this->Appointments->newEmptyEntity();
        if ($this->request->is('post')) {
            $appointment = $this->Appointments->patchEntity($appointment, $this->request->getData());
            $service = $this->Appointments->Services->get($appointment->service_id);
            $startDateTimeStr = $appointment->appointment_date->format('Y-m-d') . ' ' . $appointment->start_time->format('H:i:s');
            $startDateTime = new \DateTime($startDateTimeStr);

            $endTime = (clone $startDateTime)->add(new \DateInterval("PT{$service->duration}M"));
            $appointment->end_time = $endTime->format('H:i:s');
            $appointment->appointment_status="Scheduled";


            if ($this->Appointments->Conflicts($appointment)) {
                $this->Flash->error(__('This appointment time is already booked. Please choose a different time.'));
            } else {
                if ($this->Appointments->save($appointment)) {
                    $this->Flash->success(__('The appointment has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The appointment could not be saved. Please, try again.'));
            }
        }
        $clients = $this->Appointments->Clients->find('list', limit: 200)->all();
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $appointment = $this->Appointments->patchEntity($appointment, $this->request->getData());
            if ($this->Appointments->save($appointment)) {
                $this->Flash->success(__('The appointment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The appointment could not be saved. Please, try again.'));
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
        if ($this->Appointments->delete($appointment)) {
            $this->Flash->success(__('The appointment has been deleted.'));
        } else {
            $this->Flash->error(__('The appointment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
