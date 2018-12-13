<?php
$controller = ModuleHelper::getMainController("icanhazdadjoke");
?>
<h2 class="accordion-header"><?php
translate("icanhazdadjoke");
?></h2>
<div class="accordion-content">
<?php echo $controller->render();?>
</div>