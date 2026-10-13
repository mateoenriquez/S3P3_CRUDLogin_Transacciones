<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    /**
     * beforeFilter callback.
     *
     * @param \Cake\Event\EventInterface $event An Event instance
     * @return void
     */
    public function beforeFilter(EventInterface $event): void
    {
        parent::beforeFilter($event);

        // Allow unauthenticated access only to login and register actions
        $this->Authentication->addUnauthenticatedActions(['login', 'register']);
    }

    /**
     * Login method.
     *
     * @return \Cake\Http\Response|null|void Redirects on successful login.
     */
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();

        // If the user is logged in, redirect them
        if ($result && $result->isValid()) {
            $target = $this->Authentication->getLoginRedirect() ?? ['controller' => 'Users', 'action' => 'index'];

            return $this->redirect($target);
        }

        // Display error if user submitted and authentication failed
        if ($this->request->is('post') && (!$result || !$result->isValid())) {
            $this->Flash->error(__('Credenciales inválidas. Por favor, verifica tu correo y contraseña.'));
        }
    }

    /**
     * Logout method.
     *
     * @return \Cake\Http\Response|null Redirects to login.
     */
    public function logout()
    {
        $result = $this->Authentication->getResult();
        if ($result && $result->isValid()) {
            $this->Authentication->logout();
            $this->Flash->success(__('Has cerrado sesión correctamente.'));
        }

        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }

    /**
     * Register method (User creation).
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function register()
    {
        // If already logged in, redirect to index
        if ($this->Authentication->getIdentity()) {
            return $this->redirect(['action' => 'index']);
        }

        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Registro completado con éxito. Ahora puedes iniciar sesión.'));

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('No se pudo registrar el usuario. Por favor corrige los errores.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Index method (Protected Panel Principal / CRUD).
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * Add method (Creates a user from within the admin panel).
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Usuario registrado exitosamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo crear el usuario. Por favor intenta nuevamente.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method.
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            // Don't overwrite password if left blank
            if (empty($data['password'])) {
                unset($data['password']);
            }
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Usuario actualizado exitosamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo actualizar el usuario. Por favor intenta nuevamente.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method.
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('El usuario ha sido eliminado correctamente.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar el usuario.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
