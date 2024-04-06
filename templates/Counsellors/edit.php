<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Counsellor $counsellor
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $counsellor->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $counsellor->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Counsellors'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="counsellors form content">
            <?= $this->Form->create($counsellor) ?>
            <fieldset>
                <legend><?= __('Edit Counsellor') ?></legend>
                <?php
                    echo $this->Form->control('email');
                    echo $this->Form->control('password');
                    echo $this->Form->control('first_name');
                    echo $this->Form->control('last_name');
                    echo $this->Form->control('gender');
                    echo $this->Form->control('description');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
