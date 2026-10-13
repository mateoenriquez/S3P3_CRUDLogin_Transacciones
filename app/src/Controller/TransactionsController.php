<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Transactions Controller
 *
 * @property \App\Model\Table\TransactionsTable $Transactions
 */
class TransactionsController extends AppController
{
    /**
     * Index method.
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Transactions->find()
            ->contain(['Users'])
            ->orderBy(['Transactions.created' => 'DESC']);

        $transactions = $this->paginate($query);

        $this->set(compact('transactions'));
    }

    /**
     * Add method.
     * Accessible only for logged-in users (guaranteed by AppController).
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $transaction = $this->Transactions->newEmptyEntity();
        if ($this->request->is('post')) {
            $transaction = $this->Transactions->patchEntity($transaction, $this->request->getData());

            // Automatically associate transaction with the authenticated user
            $identity = $this->Authentication->getIdentity();
            $transaction->user_id = $identity->getIdentifier();

            if ($this->Transactions->save($transaction)) {
                $this->Flash->success(__('Transacción registrada exitosamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo guardar la transacción. Verifica la información.'));
        }

        $this->set(compact('transaction'));
    }

    /**
     * Edit method.
     *
     * @param string|null $id Transaction id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit(?string $id = null)
    {
        $transaction = $this->Transactions->get($id, contain: ['Users']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $transaction = $this->Transactions->patchEntity($transaction, $this->request->getData());
            if ($this->Transactions->save($transaction)) {
                $this->Flash->success(__('Transacción actualizada exitosamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se pudo actualizar la transacción.'));
        }

        $this->set(compact('transaction'));
    }

    /**
     * Delete method.
     *
     * @param string|null $id Transaction id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete(?string $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $transaction = $this->Transactions->get($id);
        if ($this->Transactions->delete($transaction)) {
            $this->Flash->success(__('La transacción ha sido eliminada exitosamente.'));
        } else {
            $this->Flash->error(__('No se pudo eliminar la transacción.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
