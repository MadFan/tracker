<div class="alert alert-danger">
  <strong>Error!</strong> Click (<?=$clickId?>) is duplicated.
</div>
<?php if($badDomain):
$this->registerJs('window.setTimeout(function(){window.location = "https://www.google.ru"},5000);');
endif; ?>