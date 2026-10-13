<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transaction $transaction
 */
$this->assign('title', 'Nueva Transacción');
?>
<div class="card" style="max-width: 600px; margin: 0 auto;">
    <div class="page-header">
        <div>
            <h1 class="page-title">Registrar Transacción</h1>
            <p class="page-subtitle">Ingresa los datos para registrar un nuevo movimiento financiero</p>
        </div>
        <div>
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">
                ← Ver Todas
            </a>
        </div>
    </div>

    <?= $this->Form->create($transaction) ?>
        <div class="form-group">
            <?= $this->Form->label('title', 'Título o Concepto de la Transacción') ?>
            <?= $this->Form->control('title', [
                'label' => false,
                'type' => 'text',
                'required' => true,
                'placeholder' => 'Ej. Pago de servicios, Depósito de cliente...',
                'class' => 'form-control',
                'autofocus' => true,
            ]) ?>
        </div>

        <div class="form-group">
            <?= $this->Form->label('amount', 'Monto ($ USD)') ?>
            <?= $this->Form->control('amount', [
                'label' => false,
                'type' => 'number',
                'step' => '0.01',
                'min' => '0.01',
                'required' => true,
                'placeholder' => '0.00',
                'class' => 'form-control',
            ]) ?>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 1.75rem;">
            <?= $this->Form->button(__('Guardar Transacción'), ['class' => 'btn btn-primary']) ?>
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    <?= $this->Form->end() ?>
</div>
