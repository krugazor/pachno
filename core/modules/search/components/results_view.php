<?php

/**
 * @var \pachno\core\entities\Issue[] $issues
 */

?>
<?php if ($resultcount > 0): ?>
    <div cellpadding=0 cellspacing=0 class="table dashboard_view_issues">
    <?php foreach ($issues as $issue): ?>
        <div class="tr <?php if ($issue->isClosed()): ?>issue_closed<?php else: ?>issue_open<?php endif; ?> <?php if ($issue->isBlocking()): ?>issue_blocking<?php endif; ?>">
            <div class="td issue_type_cell">
                <?php echo fa_image_tag($issue->getIssueType()->getFontAwesomeIcon(), ['title' => $issue->getIssueType()->getName()]); ?>
            </div>
            <div class="td issue_link_badge_cell">
                <div class="issue_link">
                    <?php echo link_tag($issue->getUrl(), $issue->getFormattedTitle(true), array('style' => 'text-overflow: ellipsis;')); ?>
                </div>
                <div class="status-badge" style="background-color: <?php echo ($issue->getStatus() instanceof \pachno\core\entities\Datatype) ? $issue->getStatus()->getColor() : '#FFF'; ?>;color: <?php echo ($issue->getStatus() instanceof \pachno\core\entities\Datatype) ? $issue->getStatus()->getTextColor() : '#333'; ?>;" id="status_<?php echo $issue->getID(); ?>_color">
                    <span id="status_content"><?php echo ($issue->getStatus() instanceof \pachno\core\entities\Datatype) ? __($issue->getStatus()->getName()) : __('Unknown'); ?></span>
                </div>
                <span class="secondary">
                    <?php echo __('Last updated: %updated_at', array('%updated_at' => \pachno\core\framework\Context::getI18n()->formatTime($issue->getLastUpdatedTime(), 12))); ?>
                </span>
            </div>
            <div class="td issue_comments_count_cell">
                <?php echo fa_image_tag('comments') .'&nbsp;'. $issue->getNumberOfUserComments(); ?>
            </div>
            <div class="td issue_files_count_cell">
                <?php echo fa_image_tag('paperclip') .'&nbsp;'. $issue->getNumberOfFiles(); ?>
            </div>
            <div class="td issue_avatar_cell <?php if ($issue->isAssigned()) echo ($issue->getAssignee() instanceof \pachno\core\entities\User ? 'issue_user_avatar_cell' : 'issue_team_avatar_cell'); ?>">
                <?php if ($issue->isAssigned()): ?>
                    <?php if ($issue->getAssignee() instanceof \pachno\core\entities\User): ?>
                        <?php include_component('main/userdropdown', array('user' => $issue->getAssignee(), 'size' => 'large', 'userstate' => false, 'displayname' => '')); ?>
                    <?php else: ?>
                        <?php include_component('main/teamdropdown', array('team' => $issue->getAssignee(), 'size' => 'large', 'displayname' => '')); ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="faded_out" style="padding: 5px 5px 10px 5px;"><?php echo __('No issues in this list'); ?></div>
<?php endif; ?>
     
