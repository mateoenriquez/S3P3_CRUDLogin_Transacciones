<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
$this->assign('title', 'Panel Principal - Usuarios');
?>
<div class="card">
    <div class="page-header">
        <div>
            <h1 class="page-title">Gestión de Usuarios (Superadmins)</h1>
            <p class="page-subtitle">Panel de control y administración de cuentas de usuario</p>
        </div>
        <div>
            <a href="<?= $this->Url->build(['action' => 'add']) ?>" class="btn btn-primary">
                + Nuevo Usuario
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                    <th><?= $this->Paginator->sort('email', 'Correo Electrónico') ?></th>
                    <th>Rol</th>
                    <th><?= $this->Paginator->sort('created', 'Fecha de Creación') ?></th>
                    <th><?= $this->Paginator->sort('modified', 'Última Modificación') ?></th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users) && count($users) > 0): ?>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><strong>#<?= h($user->id) ?></strong></td>
                        <td><?= h($user->email) ?></td>
                        <td><span class="badge badge-admin">Superadmin</span></td>
                        <td><?= h($user->created ? $user->created->format('d/m/Y H:i') : '-') ?></td>
                        <td><?= h($user->modified ? $user->modified->format('d/m/Y H:i') : '-') ?></td>
                        <td class="actions-cell">
                            <a href="<?= $this->Url->build(['action' => 'edit', $user->id]) ?>" class="btn btn-sm btn-secondary">
                                Editar
                            </a>
                            <?= $this->Form->postLink(
                                __('Eliminar'),
                                ['action' => 'delete', $user->id],
                                [
                                    'confirm' => __('¿Estás seguro de eliminar al usuario {0}?', $user->email),
                                    'class' => 'btn btn-sm btn-danger'
                                ]
                            ) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 2rem;">No se encontraron usuarios registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="paginator">
        <p><?= $this->Paginator->counter(__('Página {{page}} de {{pages}}, mostrando {{current}} usuario(s) de {{count}} en total')) ?></p>
        <ul class="pagination-links">
            <?= $this->Paginator->prev(__('« Anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Siguiente »')) ?>
        </ul>
    </div>
</div>
