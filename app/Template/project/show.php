<div class="page-header">
    <h2><?= t('Summary') ?></h2>
</div>
<ul class="listing">
    <li><strong><?= $project['is_active'] ? t('Active') : t('Inactive') ?></strong></li>

    <?php if ($project['is_private']): ?>
        <li><i class="fa fa-lock"></i> <?= t('This project is private') ?></li>
    <?php endif ?>

    <?php if ($project['is_public']): ?>
        <li><i class="fa fa-share-alt"></i> <?= $this->a(t('Public link'), 'board', 'readonly', array('token' => $project['token']), false, '', '', true) ?></li>
        <li><i class="fa fa-rss-square"></i> <?= $this->a(t('RSS feed'), 'project', 'feed', array('token' => $project['token']), false, '', '', true) ?></li>
    <?php else: ?>
        <li><?= t('Public access disabled') ?></li>
    <?php endif ?>

    <?php if ($project['last_modified']): ?>
        <li><?= dt('Last modified on %B %e, %Y at %k:%M %p', $project['last_modified']) ?></li>
    <?php endif ?>

    <?php if ($stats['nb_tasks'] > 0): ?>

        <?php if ($stats['nb_active_tasks'] > 0): ?>
            <li><?= $this->a(t('%d tasks on the board', $stats['nb_active_tasks']), 'board', 'show', array('project_id' => $project['id'])) ?></li>
        <?php endif ?>

        <?php if ($stats['nb_inactive_tasks'] > 0): ?>
            <li><?= $this->a(t('%d closed tasks', $stats['nb_inactive_tasks']), 'project', 'tasks', array('project_id' => $project['id'])) ?></li>
        <?php endif ?>

        <li><?= t('%d tasks in total', $stats['nb_tasks']) ?></li>

    <?php else: ?>
        <li><?= t('No task for this project') ?></li>
    <?php endif ?>
</ul>

<div class="page-header">
    <h2><?= t('Board') ?></h2>
</div>
<table id="board" class="table-stripped">
    <tr>
        <th width="50%"><?= t('Column') ?></th>
        <th><?= t('Task limit') ?></th>
        <th><?= t('Active tasks') ?></th>
    </tr>
    <?php foreach ($stats['columns'] as $column): ?>
    <tr>
        <td>
        <?= $this->e($column['title']) ?>
        <?php if (! empty($column['description'])): ?>
            <span title="<?= t('Description') ?>" class="task-board-tooltip" data-href="<?= $this->u('board', 'columndescription', array('column_id' => $column['id'], 'project_id' => $column['project_id'])) ?>">
                <i class="fa fa-file-text-o"></i>
            </span>
        <?php endif ?>
        </td>
        <td><?= $column['task_limit'] ?: '∞' ?></td>
        <td><?= $column['nb_active_tasks'] ?></td>
    </tr>
    <?php endforeach ?>
</table>
