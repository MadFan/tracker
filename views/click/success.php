<div class="alert alert-success">
  <strong>Success!</strong> Click (<?=$clickId?>) was added !
</div>
<?php if($badDomain): ?>
<div class="alert alert-warning">
  <strong>Warning!</strong> This referrer is in bad domains list.
</div>
<?php
$this->registerJs('window.setTimeout(function(){window.location = "https://www.google.ru"},5000);');
endif; ?>
