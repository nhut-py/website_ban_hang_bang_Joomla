<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$document = JFactory::getDocument();
$mediaModel = VmModel::getModel('Media');
$category_id  = vRequest::getInt ('virtuemart_category_id', 0);
// Get template settings
$app = JFactory::getApplication('site');
$tname = $app->getTemplate('template')->template;
$template = $app->getTemplate('template')->params;
$showcatthumb = $template->get('catimg');

/* ID for jQuery dropdown */
$ID = str_replace('.', '_', substr(microtime(true), -8, 8));
$document = JFactory::getDocument();
$document->addStyleDeclaration('
    img.cat-mod-img {
    	vertical-align: middle !important;
        margin: -10px 5px -10px -10px !important;
    }
    .VMmenu a{
        display: flex !important;
        align-items: center;
    }
');
$document->addScriptDeclaration("
    jQuery(document).ready(function(){
        jQuery('#VMmenu".$ID."').find('li.active').children('ul.vm-child-menu').show().siblings('button').children('span').toggleClass('glyphicon-plus glyphicon-minus');
        jQuery('#VMmenu".$ID."').find('button').click(function(event){
        	jQuery(this).children('span').toggleClass('glyphicon-plus glyphicon-minus');
        	jQuery(this).siblings('ul').slideToggle();
        	event.stopPropagation();
        });
    });
");
?>

<ul class="VMmenu <?php echo $class_sfx ?> nav nav-pills nav-stacked" id="<?php echo "VMmenu" . $ID ?>" >
    <?php foreach ($categories as $category) {
        // Get the category image
        $catimage = $mediaModel->getFiles (true,true,null,$category->virtuemart_category_id);
        $active_menu = 'VmClose';
        $caturl = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$category->virtuemart_category_id);
        if (!empty($catimage) && $showcatthumb) {
            $catimg = $catimage[0]->displayMediaThumb('class="cat-mod-img" width="35"',false,'',true,false,false,35);
        } else {
            $catimg = '';
        }
      $cattext = $catimg . '<span>' . $category->category_name . '</span>';
        if (in_array( $category->virtuemart_category_id, $parentCategories)) $active_menu = 'VmOpen active';
    ?>
    <li class="<?php echo $active_menu; ?> clearfix">
        <?php
            if (!empty($category->childs)) {
        	$span = '<button class="vm-plus btn btn-xs btn-default" type="button"><span class="glyphicon glyphicon-plus"></span></button>';
            } else {
          $span = '';
            }
            echo JHTML::link($caturl, $cattext);
            echo $span ;
        ?>

        <?php if (!empty($category->childs)) { ?>
        <ul class="vm-child-menu <?php echo $class_sfx; ?> nav small">
            <?php
                foreach ($category->childs as $child) {

                $active_child_menu = 'VmClose';
                $caturl = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$child->virtuemart_category_id);
                $cattext = vmText::_($child->category_name);

                if ($child->virtuemart_category_id == $active_category_id) {
                    $active_child_menu = 'VmOpen active';
                }
            ?>
                <li class="<?php echo $active_child_menu; ?> clearfix">
                    <?php echo JHTML::link($caturl, $cattext); ?>
                </li>
            <?php	} ?>
        </ul>
        <?php } ?>
    </li>
    <?php } ?>
</ul>