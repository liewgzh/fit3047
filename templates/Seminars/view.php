<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Seminar'), ['action' => 'edit', $seminar->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Seminar'), ['action' => 'delete', $seminar->id], ['confirm' => __('Are you sure you want to delete # {0}?', $seminar->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Seminars'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Seminar'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="seminars view content">
            <h3><?= h($seminar->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($seminar->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Video') ?></th>
                    <td>
                        <video width="320" height="240" controls>
                            <source src="<?= $this->Url->webroot('videos/' . $seminar->video_path) ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </td>

                </tr>
                <tr>
                    <th><?= __('Video Path Debug') ?></th>
                    <td><?= $this->Url->webroot($seminar->video_path) ?></td> <!-- Display the full path for debugging -->
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($seminar->created) ?></td>
                </tr>


                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($seminar->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($seminar->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
