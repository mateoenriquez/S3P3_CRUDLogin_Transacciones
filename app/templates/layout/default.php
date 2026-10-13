<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * @var \App\View\AppView $this
 * @var \Authentication\IdentityInterface|null $currentUser
 */

$appTitle = 'Sistema de Gestión y CRUD Protegido';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $appTitle ?>: <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <!-- Estilos CSS3 Nativos (Sin dependencias externas ni frameworks) -->
    <?= $this->Html->css(['custom']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="nav-container">
                <a href="<?= $this->Url->build('/') ?>" class="brand-link">
                    <span>APP</span>CASHIER
                </a>

                <ul class="nav-menu">
                    <?php if (!empty($currentUser)): ?>
                        <li>
                            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" 
                               class="nav-link <?= $this->getRequest()->getParam('controller') === 'Users' && $this->getRequest()->getParam('action') === 'index' ? 'active' : '' ?>">
                                Usuarios
                            </a>
                        </li>
                        <li>
                            <a href="<?= $this->Url->build(['controller' => 'Transactions', 'action' => 'index']) ?>" 
                               class="nav-link <?= $this->getRequest()->getParam('controller') === 'Transactions' && $this->getRequest()->getParam('action') === 'index' ? 'active' : '' ?>">
                                Transacciones
                            </a>
                        </li>
                        <li>
                            <a href="<?= $this->Url->build(['controller' => 'Transactions', 'action' => 'add']) ?>" 
                               class="nav-link <?= $this->getRequest()->getParam('controller') === 'Transactions' && $this->getRequest()->getParam('action') === 'add' ? 'active' : '' ?>">
                                + Nueva Transacción
                            </a>
                        </li>
                        <li>
                            <span class="user-badge">
                                👤 <?= h($currentUser->get('email')) ?>
                            </span>
                        </li>
                        <li>
                            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>" class="btn btn-sm btn-danger">
                                Salir
                            </a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>" class="nav-link">
                                Iniciar Sesión
                            </a>
                        </li>
                        <li>
                            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'register']) ?>" class="btn btn-sm btn-primary">
                                Registrarse
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>

    <main class="main-wrapper">
        <?= $this->Flash->render() ?>
        <?= $this->fetch('content') ?>
    </main>
</body>
</html>
