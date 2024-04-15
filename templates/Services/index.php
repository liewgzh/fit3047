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
        <a href="<?= $this->Url->build(['action' => 'add']) ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> New Service</a>
    </div>
    <?= $this->Html->link(__('New Service'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Services') ?></h3>
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th><?= h('id') ?></th>
                    <th><?= h('service_title') ?></th>
                    <th><?= h('duration') ?></th>
                    <th><?= h('price') ?></th>
                    <th><?= h('created') ?></th>
                    <th><?= h('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service): ?>
                <tr>
                    <tr>
                        <td><?= $this->Number->format($service->id) ?></td>
                        <td><?= h($service->service_title) ?></td>
                        <td><?= $this->Number->format($service->duration) ?></td>
                        <td><?= $this->Number->format($service->price) ?></td>
                        <td><?= h($service->created) ?></td>
                        <td><?= h($service->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $service->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $service->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $service->id], ['confirm' => __('Are you sure you want to delete # {0}?', $service->id)]) ?>
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
