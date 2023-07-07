/* ======================================================
 # Web357 Framework for Joomla! - v1.9.1 (free version)
 # -------------------------------------------------------
 # For Joomla! CMS (v3.x)
 # Author: Web357 (Yiannis Christodoulou)
 # Copyright (©) 2014-2022 Web357. All rights reserved.
 # License: GNU/GPLv3, http://www.gnu.org/licenses/gpl-3.0.html
 # Website: https:/www.web357.com
 # Demo: https://demo.web357.com/joomla/
 # Support: support@web357.com
 # Last modified: Thursday 17 February 2022, 03:25:10 AM
 ========================================================= */

var jQueryWeb357 = jQuery.noConflict();
jQueryWeb357(document).ready(function ($) {
    /**
     * SCREENSHOTS FOR PARAMETERS
     */
    // get paths and urls
    var baseUrl = jQueryWeb357('#baseurl').data('baseurl');
    var jversion = jQueryWeb357('#jversion').data('jversion');

    // Add the version class to the body
    jQueryWeb357('body').addClass('web357-' + jversion);

    // get screenshots array
    var screenshots = [];

    /**
     * SCREENSHOTS FOR LIMIT ACTIVE LOGINS
     */
    var lal_path =
        baseUrl +
        'media/com_limitactivelogins/images/screenshots-for-parameters/';
    screenshots.push({
        sclass: '.lal-showLoggedInDevices',
        src: lal_path + 'showLoggedInDevices.png',
        width: 1021,
        height: 699,
    });
    screenshots.push({
        sclass: '.lal-customErrorMessage',
        src: lal_path + 'customErrorMessage.png',
        width: 750,
        height: 250,
    });
    screenshots.push({
        sclass: '.lal-showGravatar',
        src: lal_path + 'showGravatar.png',
        width: 987,
        height: 216,
    });
    screenshots.push({
        sclass: '.lal-customLimits',
        src: lal_path + 'customLimits.png',
        width: 987,
        height: 216,
    });

    /**
     * SCREENSHOTS FOR COOKIES POLICY NOTIFICATION BAR
     */
    var cpnb_path =
        baseUrl +
        'plugins/system/cookiespolicynotificationbar/assets/images/screenshots-for-parameters/';
    screenshots.push({
        sclass: '.cpnb-position',
        src: cpnb_path + 'position.png',
        width: 1156,
        height: 669,
    });
    screenshots.push({
        sclass: '.cpnb-showCloseXIcon',
        src: cpnb_path + 'showCloseXIcon.png',
        width: 640,
        height: 208,
    });
    screenshots.push({
        sclass: '.cpnb-enableConfirmationAlerts',
        src: cpnb_path + 'enableConfirmationAlerts.png',
        width: 1021,
        height: 699,
    });
    screenshots.push({
        sclass: '.cpnb-notification-bar-message',
        src: cpnb_path + 'notification-bar.png',
        width: 1142,
        height: 691,
    });
    screenshots.push({
        sclass: '.cpnb-modal-info-window',
        src: cpnb_path + 'modal-info-window.png',
        width: 1145,
        height: 691,
    });
    screenshots.push({
        sclass: '.cpnb-modalState',
        src: cpnb_path + 'modalState.png',
        width: 1145,
        height: 786,
    });
    screenshots.push({
        sclass: '.cpnb-modalFloatButtonState',
        src: cpnb_path + 'modalFloatButtonState.png',
        width: 1145,
        height: 786,
    });
    screenshots.push({
        sclass: '.cpnb-modalHashLink',
        src: cpnb_path + 'modalHashLink.png',
        width: 1311,
        height: 795,
    });

    /**
     * SCREENSHOTS FOR SUPPORT HOURS
     */
    var sh_path = baseUrl + 'modules/mod_supporthours/screenshots/';
    screenshots.push({
        sclass: '.sh-display_copyright',
        src: sh_path + 'display_copyright.png',
        width: 650,
        height: 535,
    });
    screenshots.push({
        sclass: '.sh-dateformat',
        src: sh_path + 'dateformat.png',
        width: 650,
        height: 535,
    });
    screenshots.push({
        sclass: '.sh-timeformat',
        src: sh_path + 'timeformat.png',
        width: 650,
        height: 535,
    });
    screenshots.push({
        sclass: '.sh-display_pm_am',
        src: sh_path + 'display_pm_am.png',
        width: 650,
        height: 535,
    });
    screenshots.push({
        sclass: '.sh-open_hours_time_format',
        src: sh_path + 'open_hours_time_format.png',
        width: 650,
        height: 535,
    });
    screenshots.push({
        sclass: '.sh-display_gmt',
        src: sh_path + 'display_gmt.png',
        width: 650,
        height: 535,
    });
    screenshots.push({
        sclass: '.sh-display_open_hours_beside_maintext',
        src: sh_path + 'display_open_hours_beside_maintext.png',
        width: 650,
        height: 535,
    });
    screenshots.push({
        sclass: '.sh-online_text',
        src: sh_path + 'online_text.png',
        width: 650,
        height: 535,
    });
    screenshots.push({
        sclass: '.sh-front_text_available',
        src: sh_path + 'front_text_available.png',
        width: 650,
        height: 535,
    });
    screenshots.push({
        sclass: '.sh-offline_text',
        src: sh_path + 'offline_text.png',
        width: 650,
        height: 535,
    });
    screenshots.push({
        sclass: '.sh-front_text_offline',
        src: sh_path + 'front_text_offline.png',
        width: 650,
        height: 535,
    });
    screenshots.push({
        sclass: '.sh-state_text',
        src: sh_path + 'state_text.png',
        width: 650,
        height: 535,
    });
    screenshots.push({
        sclass: '.sh-show_available_left_link',
        src: sh_path + 'show_available_left_link.png',
        width: 650,
        height: 535,
    });
    screenshots.push({
        sclass: '.sh-show_available_right_link',
        src: sh_path + 'show_available_right_link.png',
        width: 650,
        height: 535,
    });
    screenshots.push({
        sclass: '.sh-show_offline_link',
        src: sh_path + 'show_offline_link.png',
        width: 650,
        height: 535,
    });
    screenshots.push({
        sclass: '.sh-box_width',
        src: sh_path + 'box_width.png',
        width: 650,
        height: 535,
    });
    screenshots.push({
        sclass: '.sh-layout',
        src: sh_path + 'layout.png',
        width: 930,
        height: 550,
    });

    /**
     * SCREENSHOTS FOR THE FIX 404 ERROR LINKS
     */
    var f404_path =
        baseUrl +
        'administrator/components/com_fix404errorlinks/assets/images/screenshots-for-parameters/';
    screenshots.push({
        sclass: '.f404-copyright',
        src: f404_path + 'f404-copyright.png',
        width: 483,
        height: 297,
    });

    /// add screenshots for parameters
    for (i = 0, len = screenshots.length; i < len; i++) {
        var sclass = screenshots[i].sclass;
        var screenshot_src = screenshots[i].src;

        if (jversion === 'j4x') {
            if ($(sclass).length > 0) {
                // check if the class exists.
                // j4
                var modal_width = screenshots[i].width + 2;
                var modal_id = sclass.replace('.', '');

                // styling
                if (
                    sclass === '.cpnb-notification-bar-message' ||
                    sclass === '.sh-front_text_available' ||
                    sclass === '.sh-front_text_offline'
                ) {
                    // textarea
                    var style =
                        'margin-left: 20px; cursor: pointer; vertical-align: top;';
                } else {
                    var style = 'margin-left: 20px; cursor: pointer; ';
                }

                //var screenshot_html = '<button type="button" title="See a Screenshot" data-toggle="modal" data-target="#'+modal_id+'" style="'+style+'"><span class="icon-eye" aria-hidden="true"></span></button><div id="'+modal_id+'" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-dialog" style="min-width: '+modal_width+'px; margin: 30px auto;"><div class="modal-content"><div class="modal-header"><h3 class="modal-title">Screenshot</h3><button type="button" class="close" data-dismiss="modal">&times;</button></div><div class="modal-body"><img src="'+screenshot_src+'" class="img-responsive"></div></div></div></div>';

                // Button trigger modal
                var screenshot_html = '';
                screenshot_html +=
                    `<button type="button" title="See a Screenshot" data-toggle="modal" data-target="#` +
                    modal_id +
                    `" data-bs-toggle="modal" data-bs-target="#` +
                    modal_id +
                    `" style="` +
                    style +
                    `">
					<span class="icon-eye" aria-hidden="true"></span>
				</button>`;

                // Modal
                screenshot_html +=
                    `<div id="` +
                    modal_id +
                    `" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog" style="min-width: ` +
                    modal_width +
                    `px; margin: 30px auto;">
						<div class="modal-content">
							<div class="modal-header">
								<h3 class="modal-title">Screenshot</h3>
								<button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<img src="` +
                    screenshot_src +
                    `" class="img-responsive">
							</div>
						</div>
					</div>
				</div>`;
            }
        } else {
            // j3x, j25x
            var screenshot_html =
                '<div style="display: inline-block; margin-left: 20px; position: relative; top: 2px;"><a href="' +
                screenshot_src +
                '" class="hasTooltip modal" data-toggle="modal" data-original-title="Click to see an example." rel="{size: {x: ' +
                screenshots[i].width +
                ', y: ' +
                screenshots[i].height +
                '}, handler:\'iframe\'}"><i class="icon-eye-open"></i></a></div>';
        }

        jQueryWeb357(screenshot_html).insertAfter(sclass);
    }

    // J4: Remove the label from subform fields in the component/plugin settings
    $('body.web357-j4x label[for="jform_params_cookie_categories_group"]')
        .parent()
        .remove();
    $('body.web357-j4x label[for="jform_custom_limits_group"]')
        .parent()
        .remove();
});
