<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Seminar $seminar
 */
?>
<div class="row">
    <div class="column column-80">
        <div class="seminars form content">
            <?= $this->Form->create($seminar, ['enctype' => 'multipart/form-data']) ?>
            <fieldset>
                <legend><?= __('Add Seminar') ?></legend>
                <?php
                echo $this->Form->control('title');
                echo $this->Form->control('description');
                echo $this->Form->control('video_path', ['type' => 'file']); // Input type should be 'file' for file uploads
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
