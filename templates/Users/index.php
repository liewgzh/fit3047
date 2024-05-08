<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\User> $users
 */
 echo $this->Html->css('/vendor/datatables/dataTables.bootstrap4.min.css', ['block' => true]);
  echo $this->Html->script('/vendor/datatables/jquery.dataTables.min.js', ['block' => true]);
  echo $this->Html->script('/vendor/datatables/dataTables.bootstrap4.min.js', ['block' => true]);
?>
<!-- new here -->
<div class="users index content">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= __('Users') ?></h1>
        <a href="<?= $this->Url->build(['action' => 'add']) ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> New User</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <tr>
                        <th><?= h('Id') ?></th>
                        <th><?= h('Profile Image') ?></th>
                        <th><?= h('First Name') ?></th>
                        <th><?= h('Last Name') ?></th>
                        <th><?= h('Email') ?></th>
                        <th><?= h('Role') ?></th>
                        <th><?= h('Gender') ?></th>
                        <th><?= h('Date Of Birth') ?></th>
                        <th><?= h('Phone Number') ?></th>
                        <th><?= h('Address') ?></th>
                        <th><?= h('Created') ?></th>
                        <th><?= h('Modified') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $this->Number->format($user->id) ?></td>
                    <td>
                        <?php if (!empty($user->image_path)): ?>
                            <img src="<?= $this->Url->webroot($user->image_path) ?>" width="50" height="50" alt="Profile Image">


                        <?php else: ?>
                            <?= $this->Html->image('default.png', ['alt' => 'No Image', 'style' => 'width:50px; height:50px;']) ?>
                        <?php endif; ?>
                    </td>
                    <td><?= h($user->first_name) ?></td>
                    <td><?= h($user->last_name) ?></td>
                    <td><?= h($user->email) ?></td>
                    <td><?= h($user->role) ?></td>
                    <td><?= h($user->gender) ?></td>
                    <td><?= h($user->date_of_birth) ?></td>
                    <td><?= h($user->phone_number) ?></td>
                    <td><?= h($user->address) ?></td>
                    <td><?= h($user->created) ?></td>
                    <td><?= h($user->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
          $('#dataTable').DataTable();
        });
    </script>>
</div>
