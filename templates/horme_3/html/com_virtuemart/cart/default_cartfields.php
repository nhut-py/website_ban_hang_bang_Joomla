<?php
defined ('_JEXEC') or die();

// Status Of Delimiter
$closeDelimiter = false;
$openTable = true;
$hiddenFields = '';

if(!empty($this->userFieldsCart['fields'])) {

	// Output: Userfields
	foreach($this->userFieldsCart['fields'] as $field) {
  	if ($field['name'] == 'customer_note') {
			$class="well";
    } else {
      $class="";
    }
	?>
	<fieldset class="vm-fieldset-<?php echo str_replace('_','-',$field['name']) . ' ' . $class ?>">
		<div  class="cart <?php echo str_replace('_','-',$field['name']) ?>" title="<?php echo strip_tags($field['description']) ?>">
			<?php
			if ($field['hidden'] == true) {
				// We collect all hidden fields
				// and output them at the end
				$hiddenFields .= $field['formcode'] . "\n";
			} else { ?>
				<label class="cart <?php echo str_replace('_','-',$field['name']) ?> block">
				<?php echo $field['title']; ?>
				<?php echo $field['formcode'] ?>
				</label>
			<?php } ?>
    </div>
	</fieldset>

	<?php
	}
	// Output: Hidden Fields
	echo $hiddenFields;
}
?>
<script>
jQuery('#customer_note_field').addClass('form-control');
</script>