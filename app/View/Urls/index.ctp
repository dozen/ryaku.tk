<?php
?>
<!-- File: /app/View/Posts/add.ctp -->
<?php echo $urlCount ?>個のURLが短縮されました。
<?php $this->Html->scriptStart(array('inline' => false))?>
$(function(){
    $('form').submit(function(){
        var postData = {};
        $('form').find(':input').each(function(){
            postData[$(this).attr('url')] = $(this).val();
        });
        $.post('/posts/add',postData,taskRender);
 
        return false;
    });
});
<?php $this->Html->scriptEnd()?>
<?php
echo $this->Form->create('Url', array('action' => 'shortcut'));
echo $this->Form->input('url', array());
echo $this->Form->end('短縮');
?>
