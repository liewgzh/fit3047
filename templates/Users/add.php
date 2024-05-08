<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="users form content">
            <?= $this->Form->create($user, ['enctype' => 'multipart/form-data']) ?>

            <fieldset>
                <legend><?= __('Add User') ?></legend>
                <?php
                    echo $this->Form->control('image_path', ['type' => 'file']);
                    echo $this->Form->control('first_name');
                    echo $this->Form->control('last_name');
                    echo $this->Form->control('email');
                    echo $this->Form->control('password');
                    echo $this->Form->control('password_confirm', [
                        'type' => 'password',
                        'label' => 'Confirm Password'
                    ]);

                    echo $this->Form->control('role', [
                        'type' => 'select',
                        'options' => [
                            'Admin' => 'Admin',
                            'Counsellor' => 'Counsellor',
                            'Client' => 'Client'
                        ],
                        'empty' => [null => 'Select Role'],
                        'label' => 'Role'
                    ]);


                    echo $this->Form->control('gender', [
                        'type' => 'select',
                        'options' => [
                            'Male' => 'Male',
                            'Female' => 'Female',
                            'Other' => 'Other'
                        ],
                        'empty' => [null => 'Select Gender'],
                        'label' => 'Gender'
                    ]);
                    echo $this->Form->control('date_of_birth');
                    echo $this->Form->control('phone_number');
                    echo $this->Form->control('address');
                    echo $this->Form->control('bio', ['maxlength' => '400']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
