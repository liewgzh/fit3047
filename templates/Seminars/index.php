<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Seminar> $seminars
 */
echo $this->Html->css('/vendor/datatables/dataTables.bootstrap4.min.css', ['block' => true]);
echo $this->Html->script('/vendor/datatables/jquery.dataTables.min.js', ['block' => true]);
echo $this->Html->script('/vendor/datatables/dataTables.bootstrap4.min.js', ['block' => true]);
?>
<div class="seminars index content">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= __('Seminars') ?></h1>
        <?php
            // Check if the logged-in user is an admin
            $currentUser = $this->request->getAttribute('identity');
            if ($currentUser && ($currentUser->role === 'Admin' || $currentUser->role === 'Counsellor') ):
            ?>
        <?= $this->Html->link(__('New Seminar'), ['action' => 'add'], ['class' => 'd-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']) ?>
        <?php endif; ?>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-sm" id="dataTable" style="width:100%">
            <thead>
            <tr>
                <th style="width:25%"><?= __('Title') ?></th>
                <th style="width:25%"><?= __('Video Path') ?></th>
                <th id="created-header" style="width:15%"><?= __('Created') ?></th>
                <th id="modified-header" style="width:15%"><?= __('Modified') ?></th>
                <th style="width:20%" class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($seminars as $seminar): ?>
                <tr>
                    <td><?= h($seminar->title) ?></td>
                    <td><?= h($seminar->video_path) ?></td>
                    <td id="created-field-<?= $seminar->id ?>" class="created-field"><?= h($seminar->created) ?></td>
                    <td id="modified-field-<?= $seminar->id ?>" class="modified-field"><?= h($seminar->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $seminar->id], ['class' => 'btn btn-primary']) ?>
                        <?php
                        // Check if the logged-in user is an admin
                        $currentUser = $this->request->getAttribute('identity');
                        if ($currentUser && ($currentUser->role === 'Admin' || $currentUser->role === 'Counsellor')):
                        ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $seminar->id], ['class' => 'btn btn-primary']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $seminar->id], ['confirm' => __('Are you sure you want to delete # {0}?', $seminar->id), 'class' => 'btn btn-danger']) ?>
                       <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    // Function to hide "Created" and "Modified" fields based on window width
    function hideFieldsOnMobile() {
        if (window.innerWidth <= 768) {
            document.getElementById("created-header").style.display = "none";
            document.getElementById("modified-header").style.display = "none";
            <?php foreach ($seminars as $seminar): ?>
                document.getElementById("created-field-<?= $seminar->id ?>").style.display = "none";
                document.getElementById("modified-field-<?= $seminar->id ?>").style.display = "none";
            <?php endforeach; ?>
        } else {
            // Show the fields if the window width is greater than 768px
            document.getElementById("created-header").style.display = "";
            document.getElementById("modified-header").style.display = "";
            <?php foreach ($seminars as $seminar): ?>
                document.getElementById("created-field-<?= $seminar->id ?>").style.display = "";
                document.getElementById("modified-field-<?= $seminar->id ?>").style.display = "";
            <?php endforeach; ?>
        }
    }

    // Call the function initially when the page loads
    document.addEventListener("DOMContentLoaded", hideFieldsOnMobile);

    // Add event listener to detect window resize
    window.addEventListener("resize", hideFieldsOnMobile);
</script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
