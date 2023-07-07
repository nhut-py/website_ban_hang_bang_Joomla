<?php
/**
 *
 * Show the product details page
 *
 * @package    VirtueMart
 * @subpackage
 * @author Max Milbers, Valerie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_reviews.php 8508 2014-10-22 18:57:14Z Milbo $
 */

// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die ('Restricted access');

// Customer Reviews
$review_editable = true;
if ($this->allowRating || $this->allowReview || $this->showRating || $this->showReview) {

	$maxrating = VmConfig::get( 'vm_maximum_rating_scale', 5 );
	$ratingsShow = VmConfig::get( 'vm_num_ratings_show', 3 ); // TODO add  vm_num_ratings_show in vmConfig
	$stars = array();
	//$showall = vRequest::getBool( 'showall', FALSE );
	$ratingWidth = $maxrating*24;
	for( $num = 0; $num<=$maxrating; $num++ ) {
		$stars[] = '
				<span title="'.(vmText::_( "COM_VIRTUEMART_RATING_TITLE" ).$num.'/'.$maxrating).'" class="vmicon ratingbox" style="display:inline-block;width:'. 24*$maxrating.'px;">
					<span class="stars-orange" style="width:'.(24*$num).'px">
					</span>
				</span>';
	}
?>
<?php
if ($this->showReview) { ?>
<h3 class="page-header"><?php echo vmText::_ ('COM_VIRTUEMART_REVIEWS') ?></h3>
<div class="customer-reviews row">
	<div class="col-md-12">
<?php
	if ($this->rating_reviews) {
		foreach( $this->rating_reviews as $review ) {
			/* Check if user already commented */
			// if ($review->virtuemart_userid == $this->user->id ) {
			if ($review->created_by == $this->user->id && !$review->review_editable) {
				$review_editable = false;
			}
		}
	}
}

	if ($this->allowRating or $this->allowReview) {

	if ($review_editable) {
?>

		<form method="post"
			  action="<?php echo JRoute::_( 'index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$this->product->virtuemart_product_id.'&virtuemart_category_id='.$this->product->virtuemart_category_id, FALSE ); ?>"
			  name="reviewForm" id="reviewform">

			<?php if($this->allowRating and $review_editable) { ?>

				<div class="lead">
					<?php echo vmText::_( 'COM_VIRTUEMART_WRITE_REVIEW' ) ;
					if(count( $this->rating_reviews ) == 0) {
					?>
					<span class="small"><?php echo vmText::_( 'COM_VIRTUEMART_WRITE_FIRST_REVIEW' ) ?></span>
					<?php } ?>
				</div>
				<div class="alert alert-notice"><?php echo vmText::_( 'COM_VIRTUEMART_RATING_FIRST_RATE' ) ?></div>
				<div class="rating form-inline form-group text-center">
					<!--<label for="vote"><?php echo $stars[$maxrating]; ?></label>-->
					<label>
						<input id="vote" type="radio" name="vote" value="1"> 1
          </label>
					<label>
						<input id="vote" type="radio" name="vote" value="2"> 2
          </label>
					<label>
						<input id="vote" type="radio" name="vote" value="3"> 3
          </label>
					<label>
						<input id="vote" type="radio" name="vote" value="4"> 4
          </label>
					<label>
						<input id="vote" type="radio" name="vote" value="5" checked="checked"> 5
          </label>
					<!--<input type="hidden" id="vote" value="<?php echo $maxrating ?>" name="vote">-->
				</div>

				<?php

			}

			// Writing A Review
			if ($this->allowReview and $review_editable) {
			?>
			<div class="write-reviews">

				<?php // Show Review Length While Your Are Writing
				$reviewJavascript = "
					function check_reviewform() {

					var form = document.getElementById('reviewform');
					var ausgewaehlt = false;

						if (form.comment.value.length < ".VmConfig::get( 'reviews_minimum_comment_length', 100 ).") {
							alert('".addslashes( vmText::sprintf( 'COM_VIRTUEMART_REVIEW_ERR_COMMENT1_JS', VmConfig::get( 'reviews_minimum_comment_length', 100 ) ) )."');
							return false;
						}
						else if (form.comment.value.length > ".VmConfig::get( 'reviews_maximum_comment_length', 2000 ).") {
							alert('".addslashes( vmText::sprintf( 'COM_VIRTUEMART_REVIEW_ERR_COMMENT2_JS', VmConfig::get( 'reviews_maximum_comment_length', 2000 ) ) )."');
							return false;
						}
						else {
							return true;
						}
					}

					function refresh_counter() {
						var form = document.getElementById('reviewform');
						form.counter.value= form.comment.value.length;
					}
					";
				vmJsApi::addJScript( 'check_reviewform', $reviewJavascript );
				?>
        <div class="form-group">
					<label class="step" for="comment">
					<?php echo vmText::sprintf( 'COM_VIRTUEMART_REVIEW_COMMENT', VmConfig::get( 'reviews_minimum_comment_length', 100 ), VmConfig::get( 'reviews_maximum_comment_length', 2000 ) ); ?>
					</label>
					<textarea class="virtuemart" title="<?php echo vmText::_( 'COM_VIRTUEMART_WRITE_REVIEW' ) ?>"
					  class="inputbox" id="comment" onblur="refresh_counter();" onfocus="refresh_counter();"
					  onkeyup="refresh_counter();" name="comment" rows="5"
					  cols="60"><?php if(!empty($this->review->comment)) {
						echo $this->review->comment;
						} ?></textarea>
			  </div>
				<div class="form-group form-inline">
					<input class="btn btn-primary" type="submit" onclick="return( check_reviewform());"
				   name="submit_review" title="<?php echo vmText::_( 'COM_VIRTUEMART_REVIEW_SUBMIT' ) ?>"
				   value="<?php echo vmText::_( 'COM_VIRTUEMART_REVIEW_SUBMIT' ) ?>"/>
					<?php } else if($review_editable and $this->allowRating) { ?>
					<input class="btn btn-default" type="submit" name="submit_review"
						title="<?php echo vmText::_( 'COM_VIRTUEMART_REVIEW_SUBMIT' ) ?>"
						value="<?php echo vmText::_( 'COM_VIRTUEMART_REVIEW_SUBMIT' ) ?>"/>
					<?php } ?>
					<label class="pull-right"><?php echo vmText::_( 'COM_VIRTUEMART_REVIEW_COUNT' ) ?>
						<input type="text" value="0" size="4" name="counter" maxlength="4" readonly="readonly"/>
					</label>
				</div>
			</div>
			<input type="hidden" name="virtuemart_product_id" value="<?php echo $this->product->virtuemart_product_id; ?>"/>
			<input type="hidden" name="option" value="com_virtuemart"/>
			<input type="hidden" name="virtuemart_category_id" value="<?php echo vRequest::getInt( 'virtuemart_category_id' ); ?>"/>
			<input type="hidden" name="virtuemart_rating_review_id" value="0"/>
			<input type="hidden" name="task" value="review"/>
		</form>
		<hr>
	<?php
	} else if(!$review_editable) {
		echo '<p><strong>'.vmText::_( 'COM_VIRTUEMART_DEAR' ).$this->user->name.',</strong></p>';
		echo '<div class="alert alert-info">' . vmText::_( 'COM_VIRTUEMART_REVIEW_ALREADYDONE' ) . '</div>';
	}
}

  if ($this->showReview) {
	?>

	<div class="list-reviews">
		<?php
		$i = 0;
		//$review_editable = TRUE;
		$reviews_published = 0;
		if ($this->rating_reviews) {
			foreach ($this->rating_reviews as $review) {
				if ($i % 2 == 0) {
					$color = 'normal';
				} else {
					$color = 'well well-sm';
				}
				?>

				<?php // Loop through all reviews
				if (!empty($this->rating_reviews) && $review->published) {
					$reviews_published++;
					if ($color != 'normal') {
						echo '<hr>';
					}
					?>
					<div class="<?php echo $color ?> form-group">
            <div class="row">
							<div class="ratingbox col-sm-4 text-center">
							<?php
							for ($x= intval($review->review_rating); $x<= 5 && $x > 0; $x--) {
                echo '<span class="glyphicon glyphicon-star vote"></span> ';
							}
							?>
							</div>
							<div class="col-sm-4 text-center"><span class="glyphicon glyphicon-user"></span> <b><?php echo $review->customer; ?></b></div>
							<div class="col-sm-4 date small text-center"><?php echo JHtml::date ($review->created_on, vmText::_ ('DATE_FORMAT_LC')); ?></div>
            </div>
						<div class="margin-top-15">
							<blockquote><?php echo $review->comment; ?></blockquote>
						</div>
					</div>
					<?php
				}
				$i++;
				if ($i == $ratingsShow && !$this->showall) {
					/* Show all reviews ? */
					if ($reviews_published >= $ratingsShow) {
						$attribute = array('class'=> 'details', 'title'=> vmText::_ ('COM_VIRTUEMART_MORE_REVIEWS'));
						echo JHtml::link ($this->more_reviews, vmText::_ ('COM_VIRTUEMART_MORE_REVIEWS'), $attribute);
					}
					break;
				}
			}

		} else {
			// "There are no reviews for this product"
		?>
			<div class="alert alert-info"><?php echo vmText::_ ('COM_VIRTUEMART_NO_REVIEWS') ?></div>
		<?php
		}
		?>
	</div>
<?php
}
if ($this->showReview) {
?>
	</div>
</div>
<?php
 }
}
?>