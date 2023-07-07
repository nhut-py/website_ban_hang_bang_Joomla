<?php // no direct access
defined('_JEXEC') or die('Restricted access');
vmJsApi::jQuery();
//vmJsApi::chosenDropDowns();
$moduleclass_sfx = $params->get('moduleclass_sfx');

if (!empty($text_before)) { ?>
<p><?php echo $text_before; ?></p>
<?php } ?>

<form action="<?php echo vmURI::getCurrentUrlBy('get',true) ?>" method="post" class="<?php echo $moduleclass_sfx; ?>">
	<div class="input-group input-group-xs">
		<?php echo JHTML::_('select.genericlist', $currencies, 'virtuemart_currency_id', 'class="inputbox  form-control input-sm"', 'virtuemart_currency_id', 'currency_txt', $virtuemart_currency_id) ; ?>
    <span class="input-group-btn">
    	<button class="btn btn-primary btn-xs" type="submit" name="submit" title="<?php echo vmText::_('MOD_VIRTUEMART_CURRENCIES_CHANGE_CURRENCIES') ?>">
      	<span class="glyphicon glyphicon-refresh"></span>
			</button>
    </span>
	</div>
</form>