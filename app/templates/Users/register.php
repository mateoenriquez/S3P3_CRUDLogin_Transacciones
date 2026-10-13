<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$this->assign('title', 'Registro de Usuario');
?>
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <h1>Crear Cuenta</h1>
            <p>Registra un nuevo usuario para ingresar al sistema</p>
        </div>

        <?= $this->Form->create($user, ['class' => 'auth-form']) ?>
            <div class="form-group">
                <?= $this->Form->label('email', 'Correo Electrónico') ?>
                <?= $this->Form->control('email', [
                    'label' => false,
                    'type' => 'email',
                    'required' => true,
                    'placeholder' => 'usuario@correo.com',
                    'class' => 'form-control',
                    'autofocus' => true,
                ]) ?>
            </div>

            <div class="form-group">
                <?= $this->Form->label('password', 'Contraseña') ?>
                <?= $this->Form->control('password', [
                    'label' => false,
                    'type' => 'password',
                    'required' => true,
                    'placeholder' => 'Mínimo 6 caracteres',
                    'class' => 'form-control',
                ]) ?>
            </div>

            <?= $this->Form->button(__('Completar Registro'), ['class' => 'btn btn-primary btn-block']) ?>
        <?= $this->Form->end() ?>

        <div class="auth-footer">
            ¿Ya tienes una cuenta? 
            <a href="<?= $this->Url->build(['action' => 'login']) ?>">Inicia sesión aquí</a>
        </div>
    </div>
</div>
