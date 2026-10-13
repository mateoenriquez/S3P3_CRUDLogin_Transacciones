<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Transaction> $transactions
 */
$this->assign('title', 'Transacciones');
?>
<div class="card">
    <div class="page-header">
        <div>
            <h1 class="page-title">Módulo de Transacciones</h1>
            <p class="page-subtitle">Historial de movimientos financieros registrados</p>
        </div>
        <div>
            <a href="<?= $this->Url->build(['action' => 'add']) ?>" class="btn btn-primary">
                + Nueva Transacción
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('title', 'Título / Concepto') ?></th>
                    <th><?= $this->Paginator->sort('amount', 'Monto') ?></th>
                    <th>Registrado por</th>
                    <th><?= $this->Paginator->sort('created', 'Fecha') ?></th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($transactions) && count($transactions) > 0): ?>
                    <?php foreach ($transactions as $transaction): ?>
                    <tr>
                        <td><strong>#<?= h($transaction->id) ?></strong></td>
                        <td><strong><?= h($transaction->title) ?></strong></td>
                        <td><span class="amount-value">$<?= number_format((float)$transaction->amount, 2) ?></span></td>
                        <td><?= h($transaction->user->email ?? 'N/A') ?></td>
                        <td><?= h($transaction->created ? $transaction->created->format('d/m/Y H:i') : '-') ?></td>
                        <td class="actions-cell">
                            <a href="<?= $this->Url->build(['action' => 'edit', $transaction->id]) ?>" class="btn btn-sm btn-secondary">
                                Editar
                            </a>
                            <?= $this->Form->postLink(
                                __('Eliminar'),
                                ['action' => 'delete', $transaction->id],
                                [
                                    'confirm' => __('¿Deseas eliminar la transacción "{0}"?', $transaction->title),
                                    'class' => 'btn btn-sm btn-danger'
                                ]
                            ) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 2rem;">No hay transacciones registradas. ¡Crea la primera!</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="paginator">
        <p><?= $this->Paginator->counter(__('Página {{page}} de {{pages}}, mostrando {{current}} transacción(es) de {{count}} en total')) ?></p>
        <ul class="pagination-links">
            <?= $this->Paginator->prev(__('« Anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Siguiente »')) ?>
        </ul>
    </div>
</div>
