<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$this->assign('title', 'Editar Usuario');
?>
<div class="card" style="max-width: 600px; margin: 0 auto;">
    <div class="page-header">
        <div>
            <h1 class="page-title">Editar Usuario</h1>
            <p class="page-subtitle">Modifica la información de la cuenta #<?= h($user->id) ?></p>
        </div>
        <div>
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">
                ← Volver al Panel
            </a>
        </div>
    </div>

    <?= $this->Form->create($user) ?>
        <div class="form-group">
            <?= $this->Form->label('email', 'Correo Electrónico') ?>
            <?= $this->Form->control('email', [
                'label' => false,
                'type' => 'email',
                'required' => true,
                'class' => 'form-control',
            ]) ?>
        </div>

        <div class="form-group">
            <?= $this->Form->label('password', 'Nueva Contraseña (dejar en blanco si no deseas cambiarla)') ?>
            <?= $this->Form->control('password', [
                'label' => false,
                'type' => 'password',
                'required' => false,
                'value' => '',
                'placeholder' => 'Escribe una nueva contraseña para actualizar',
                'class' => 'form-control',
            ]) ?>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
            <?= $this->Form->button(__('Guardar Cambios'), ['class' => 'btn btn-primary']) ?>
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    <?= $this->Form->end() ?>
</div>
