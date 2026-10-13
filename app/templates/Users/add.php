<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$this->assign('title', 'Nuevo Usuario');
?>
<div class="card" style="max-width: 600px; margin: 0 auto;">
    <div class="page-header">
        <div>
            <h1 class="page-title">Registrar Nuevo Usuario</h1>
            <p class="page-subtitle">Crea una nueva cuenta de usuario o superadmin</p>
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
                'placeholder' => 'usuario@correo.com',
            ]) ?>
        </div>

        <div class="form-group">
            <?= $this->Form->label('password', 'Contraseña') ?>
            <?= $this->Form->control('password', [
                'label' => false,
                'type' => 'password',
                'required' => true,
                'class' => 'form-control',
                'placeholder' => 'Mínimo 6 caracteres',
            ]) ?>
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
            <?= $this->Form->button(__('Guardar Usuario'), ['class' => 'btn btn-primary']) ?>
            <a href="<?= $this->Url->build(['action' => 'index']) ?>" class="btn btn-secondary">Cancelar</a>
        </div>
    <?= $this->Form->end() ?>
</div>
