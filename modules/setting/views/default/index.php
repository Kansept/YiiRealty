<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="setting-default-index">
    <?= Html::button('Проверить версию', [
        'id' => 'check_version',
        'class' => 'btn btn-primary',
    ]) ?>
    <span id="version_info"></span>
</div>

<?php
$linkUpdate = Url::to(['/admin/setting/default/update']);
$linkCheckVersion = Url::to(['/admin/setting/default/check-version']);
$this->registerJs("

  $('#check_version').click( function() {
    $.get('$linkCheckVersion', function(data) { 
      if (data) {
        $('#version_info')
          .html(' Доступна новая версия ' + data['version'] + ' <b><a href=\"$linkUpdate\">Обновить</a></b>');
      }
    });
  });

");
?>
