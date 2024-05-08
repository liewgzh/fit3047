<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Service> $services
 */
 echo $this->Html->css('/vendor/datatables/dataTables.bootstrap4.min.css', ['block' => true]);
  echo $this->Html->script('/vendor/datatables/jquery.dataTables.min.js', ['block' => true]);
  echo $this->Html->script('/vendor/datatables/dataTables.bootstrap4.min.js', ['block' => true]);
?>

<!-- new here -->
<div class="services index content">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= __('Services') ?></h1>
        <?php
        // Check if the logged-in user is an admin
        $currentUser = $this->request->getAttribute('identity');
        if ($currentUser && $currentUser->role === 'Admin'):
        ?>
        <a href="<?= $this->Url->build(['action' => 'add']) ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> New Service</a>
        <?php endif; ?>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>

                    <th><?= h('Title') ?></th>
                    <th><?= h('Duration') ?></th>
                    <th><?= h('Price') ?></th>

                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service): ?>
                <tr>
                    <tr>

                        <td><?= h($service->service_title) ?></td>
                        <td><?= $this->Number->format($service->duration) ?></td>
                        <td><?= $this->Number->format($service->price) ?></td>

                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $service->id], ['class' => 'btn btn-primary']) ?>
                            <?php
                            // Check if the logged-in user is an admin
                            if ($currentUser && $currentUser->role === 'Admin'):
                            ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $service->id], ['class' => 'btn btn-primary']) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $service->id], ['confirm' => __('Are you sure you want to delete # {0}?', $service->id), 'class' => 'btn btn-danger']) ?>
                            <?php endif; ?>
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
