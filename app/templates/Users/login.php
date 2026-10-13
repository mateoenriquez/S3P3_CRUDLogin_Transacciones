<?php
/**
 * @var \App\View\AppView $this
 */
$this->assign('title', 'Iniciar Sesión');
?>
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <h1>Iniciar Sesión</h1>
            <p>Accede con tus credenciales para administrar el sistema</p>
        </div>

        <?= $this->Form->create(null, ['class' => 'auth-form']) ?>
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
                    'placeholder' => '••••••••',
                    'class' => 'form-control',
                ]) ?>
            </div>

            <?= $this->Form->button(__('Ingresar al Sistema'), ['class' => 'btn btn-primary btn-block']) ?>
        <?= $this->Form->end() ?>

        <div class="auth-footer">
            ¿No tienes cuenta aún? 
            <a href="<?= $this->Url->build(['action' => 'register']) ?>">Crear una cuenta</a>
        </div>
    </div>
</div>
