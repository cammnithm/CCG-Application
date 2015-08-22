<?php
/**
 * @version     1.0.0
 * @package     com_ccgslider
 * @copyright   Copyright (C) 2015. Alle Rechte vorbehalten.
 * @license     GNU General Public License Version 2 oder später; siehe LICENSE.txt
 * @author      Timma <dieudonnetimma@yahoo.fr> - http://www.camgiess.de
 */
// no direct access
defined('_JEXEC') or die;

$canEdit = JFactory::getUser()->authorise('core.edit', 'com_ccgslider.' . $this->item->id);
if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_ccgslider' . $this->item->id)) {
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>
<?php if ($this->item) : ?>

    <div class="item_fields">
        <!--<table class="table">
            <tr>
			<th><?php echo JText::_('COM_CCGSLIDER_FORM_LBL_SLIDER_ID'); ?></th>
			<td><?php echo $this->item->id; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_CCGSLIDER_FORM_LBL_SLIDER_STATE'); ?></th>
			<td>
			<i class="icon-<?php echo ($this->item->state == 1) ? 'publish' : 'unpublish'; ?>"></i></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_CCGSLIDER_FORM_LBL_SLIDER_CREATED_BY'); ?></th>
			<td><?php echo $this->item->created_by_name; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_CCGSLIDER_FORM_LBL_SLIDER_TITLE'); ?></th>
			<td><?php echo $this->item->title; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_CCGSLIDER_FORM_LBL_SLIDER_FILE'); ?></th>
			<td>
			<?php $uploadPath = 'administrator' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_ccgslider' . DIRECTORY_SEPARATOR . 'image' . DIRECTORY_SEPARATOR . $this->item->file; ?>
			<a href="<?php echo JRoute::_(JUri::base() . $uploadPath, false); ?>" target="_blank"><?php echo $this->item->file; ?></a></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_CCGSLIDER_FORM_LBL_SLIDER_DESCRIPTION'); ?></th>
			<td><?php echo $this->item->description; ?></td>
</tr>

        </table>-->
        <!-- it works the same with all jquery version from 1.x to 2.x -->
        <!-- use jssor.slider.mini.js (40KB) instead for release -->
        
        
        <script src="<?php echo JURI::root(true); ?>/components/com_ccgslider/assets/JssorSlider/js/jquery.min.js" type="text/javascript"></script>
        <!-- jssor.slider.mini.js = (jssor.js + jssor.slider.js) -->
        <script src="<?php echo JURI::root(true); ?>/components/com_ccgslider/assets/JssorSlider/js/jssor.js" type="text/javascript"></script>
        <script src="<?php echo JURI::root(true); ?>/components/com_ccgslider/assets/JssorSlider/js/jssor.slider.min.js" type="text/javascript"></script>
        <script>
            function appendImages(imageList) {
                $('#jssorSlidesContainer').empty();
                imageList.map(function (image) {
                    $('#jssorSlidesContainer').append('<div><img u=image src="' + image.url + '" /><div u="' + image.type1 + '">' + image.title1 + '</div><div u="' + image.type2 + '" t="L" style="position: absolute; top: 20px; left: 20px; width: 200px; height: 30px; color: #ffffff; font-size: 20px; line-height: 30px;">' + image.title2 + '</div><div u="' + image.type + '" t="CLIP|LR" style="position: absolute; top: 135px; left: 100px; width: 400px; height: 30px; color: #ffffff; font-size: 26px; line-height: 30px; text-align: center;">' + image.title1 + '</div></div>');
                });

            }

        </script>
        <script>
            jQuery(document).ready(function ($) {
                //Reference http://www.jssor.com/development/slider-with-slideshow-no-jquery.html
                //Reference http://www.jssor.com/development/tool-slideshow-transition-viewer.html

                var _SlideshowTransitions = [
                    //Fade Fly in R
                    {$Duration: 1200, x: -0.3, $During: {$Left: [0.3, 0.7]}, $Easing: {$Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2, $Outside: true}
                    //Fade Fly out L
                    , {$Duration: 1200, x: 0.3, $SlideOut: true, $Easing: {$Left: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2, $Outside: true}
                ];

                //Reference http://www.jssor.com/development/slider-with-caption-no-jquery.html
                //Reference http://www.jssor.com/development/reference-ui-definition.html#captiondefinition
                //Reference http://www.jssor.com/development/tool-caption-transition-viewer.html

                var _CaptionTransitions = [];
                _CaptionTransitions["L"] = {$Duration: 800, x: 0.6, $Easing: {$Left: $JssorEasing$.$EaseInOutSine}, $Opacity: 2};
                _CaptionTransitions["R"] = {$Duration: 800, x: -0.6, $Easing: {$Left: $JssorEasing$.$EaseInOutSine}, $Opacity: 2};
                _CaptionTransitions["T"] = {$Duration: 800, y: 0.6, $Easing: {$Top: $JssorEasing$.$EaseInOutSine}, $Opacity: 2};
                _CaptionTransitions["B"] = {$Duration: 800, y: -0.6, $Easing: {$Top: $JssorEasing$.$EaseInOutSine}, $Opacity: 2};
                _CaptionTransitions["TL"] = {$Duration: 800, x: 0.6, y: 0.6, $Easing: {$Left: $JssorEasing$.$EaseInOutSine, $Top: $JssorEasing$.$EaseInOutSine}, $Opacity: 2};
                _CaptionTransitions["TR"] = {$Duration: 800, x: -0.6, y: 0.6, $Easing: {$Left: $JssorEasing$.$EaseInOutSine, $Top: $JssorEasing$.$EaseInOutSine}, $Opacity: 2};
                _CaptionTransitions["BL"] = {$Duration: 800, x: 0.6, y: -0.6, $Easing: {$Left: $JssorEasing$.$EaseInOutSine, $Top: $JssorEasing$.$EaseInOutSine}, $Opacity: 2};
                _CaptionTransitions["BR"] = {$Duration: 800, x: -0.6, y: -0.6, $Easing: {$Left: $JssorEasing$.$EaseInOutSine, $Top: $JssorEasing$.$EaseInOutSine}, $Opacity: 2};

                _CaptionTransitions["CLIP|LR"] = {$Duration: 600, $Clip: 3, $Easing: $JssorEasing$.$EaseInOutCubic};
                _CaptionTransitions["MCLIP|L"] = {$Duration: 600, $Clip: 1, $Move: true, $Easing: $JssorEasing$.$EaseInOutCubic};
                _CaptionTransitions["LISTH|L"] = {$Duration: 1000, x: 0.8, $Clip: 1, $Easing: $JssorEasing$.$EaseInOutCubic, $ScaleClip: 0.8, $Opacity: 2, $During: {$Left: [0.4, 0.6], $Clip: [0, 0.4], $Opacity: [0.4, 0.6]}};
                _CaptionTransitions["WAVE|L"] = {$Duration: 1300, x: 0.6, y: 0.3, $Easing: {$Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseInWave}, $Opacity: 2, $Round: {$Top: 2.5}};
                _CaptionTransitions["JUMPDN|R"] = {$Duration: 1000, x: -0.6, y: 0.4, $Easing: {$Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseOutJump}, $Round: {$Top: 1.5}};
                _CaptionTransitions["DDG|TR"] = {$Duration: 1200, x: -0.3, y: 0.3, $Zoom: 1, $Easing: {$Left: $JssorEasing$.$EaseInJump, $Top: $JssorEasing$.$EaseInJump}, $Opacity: 2, $During: {$Left: [0, 0.8], $Top: [0, 0.8]}, $Round: {$Left: 0.8, $Top: 0.8}};
                _CaptionTransitions["DODGEDANCE|L"] = {$Duration: 1200, x: 0.3, y: -0.3, $Zoom: 1, $Easing: {$Left: $JssorEasing$.$EaseInJump, $Top: $JssorEasing$.$EaseInJump, $Zoom: $JssorEasing$.$EaseOutQuad}, $Opacity: 2, $During: {$Left: [0, 0.8], $Top: [0, 0.8]}, $Round: {$Left: 0.8, $Top: 2.5}};
                _CaptionTransitions["FLUTTER|L"] = {$Duration: 600, x: 0.2, y: -0.1, $Easing: {$Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseInWave}, $Opacity: 2, $Round: {$Top: 1.3}};
                _CaptionTransitions["TORTUOUS|VB"] = {$Duration: 1200, y: -0.2, $Zoom: 1, $Easing: {$Top: $JssorEasing$.$EaseOutWave, $Zoom: $JssorEasing$.$EaseOutCubic}, $Opacity: 2, $During: {$Top: [0, 0.7]}, $Round: {$Top: 1.3}};
                _CaptionTransitions["FADE"] = {$Duration: 600, $Opacity: 2};
                _CaptionTransitions["ZMF|10"] = {$Duration: 600, $Zoom: 11, $Easing: {$Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear}, $Opacity: 2};
                _CaptionTransitions["RTT|10"] = {$Duration: 600, $Zoom: 11, $Rotate: 1, $Easing: {$Zoom: $JssorEasing$.$EaseInExpo, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInExpo}, $Opacity: 2, $Round: {$Rotate: 0.8}};
                _CaptionTransitions["RTTL|BR"] = {$Duration: 600, x: -0.6, y: -0.6, $Zoom: 11, $Rotate: 1, $Easing: {$Left: $JssorEasing$.$EaseInCubic, $Top: $JssorEasing$.$EaseInCubic, $Zoom: $JssorEasing$.$EaseInCubic, $Opacity: $JssorEasing$.$EaseLinear, $Rotate: $JssorEasing$.$EaseInCubic}, $Opacity: 2, $Round: {$Rotate: 0.8}};

                var options = {
                    $AutoPlay: true, //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                    $AutoPlaySteps: 1, //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                    $AutoPlayInterval: 4000, //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                    $PauseOnHover: 1, //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                    $ArrowKeyNavigation: true, //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                    $SlideDuration: 500, //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                    $MinDragOffsetToSlide: 20, //[Optional] Minimum drag offset to trigger slide , default value is 20
                    //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                    //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                    $SlideSpacing: 0, //[Optional] Space between each slide in pixels, default value is 0
                    $DisplayPieces: 1, //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                    $ParkingPosition: 0, //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                    $UISearchMode: 1, //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                    $PlayOrientation: 1, //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                    $DragOrientation: 3, //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

                    $SlideshowOptions: {//[Optional] Options to specify and enable slideshow or not
                        $Class: $JssorSlideshowRunner$, //[Required] Class to create instance of slideshow
                        $Transitions: _SlideshowTransitions, //[Required] An array of slideshow transitions to play slideshow
                        $TransitionsOrder: 1, //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
                        $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
                    },
                    $CaptionSliderOptions: {//[Optional] Options which specifies how to animate caption
                        $Class: $JssorCaptionSlider$, //[Required] Class to create instance to animate caption
                        $CaptionTransitions: _CaptionTransitions, //[Required] An array of caption transitions to play caption, see caption transition section at jssor slideshow transition builder
                        $PlayInMode: 1, //[Optional] 0 None (no play), 1 Chain (goes after main slide), 3 Chain Flatten (goes after main slide and flatten all caption animations), default value is 1
                        $PlayOutMode: 3                                 //[Optional] 0 None (no play), 1 Chain (goes before main slide), 3 Chain Flatten (goes before main slide and flatten all caption animations), default value is 1
                    },
                    $BulletNavigatorOptions: {//[Optional] Options to specify and enable navigator or not
                        $Class: $JssorBulletNavigator$, //[Required] Class to create navigator instance
                        $ChanceToShow: 2, //[Required] 0 Never, 1 Mouse Over, 2 Always
                        $ActionMode: 3, //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                        $Lanes: 2, //[Optional] Specify lanes to arrange items, default value is 1
                        $SpacingX: 10, //[Optional] Horizontal space between each item in pixel, default value is 0
                        $SpacingY: 10                                    //[Optional] Vertical space between each item in pixel, default value is 0
                    },
                    $ArrowNavigatorOptions: {
                        $Class: $JssorArrowNavigator$, //[Requried] Class to create arrow navigator instance
                        $ChanceToShow: 1                                //[Required] 0 Never, 1 Mouse Over, 2 Always
                    },
                    $ThumbnailNavigatorOptions: {
                        $Class: $JssorThumbnailNavigator$, //[Required] Class to create thumbnail navigator instance
                        $ChanceToShow: 2, //[Required] 0 Never, 1 Mouse Over, 2 Always
                        $ActionMode: 0, //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                        $DisableDrag: true, //[Optional] Disable drag or not, default value is false
                        $Orientation: 2                                 //[Optional] Orientation to arrange thumbnails, 1 horizental, 2 vertical, default value is 1
                    }
                };


                $.ajax({
                    url: "index.php?option=com_ccgslider&task=slider.getSliderImage&format=json&id=<?php echo $this->item->id; ?>",
                    success: function (data) {
                        console.log(data);
                        appendImages(data);

                        var jssor_slider1 = new $JssorSlider$("slider1_container", options);
                        //responsive code begin
                        //you can remove responsive code if you don't want the slider scales while window resizes
                        function ScaleSlider() {
                            var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                            if (parentWidth)
                                jssor_slider1.$ScaleWidth(Math.min(parentWidth, 600));
                            else
                                window.setTimeout(ScaleSlider, 30);
                        }
                        ScaleSlider();

                        $(window).bind("load", ScaleSlider);
                        $(window).bind("resize", ScaleSlider);
                        $(window).bind("orientationchange", ScaleSlider);
                    }
                });


                //responsive code end
            });
        </script>
        <!-- Jssor Slider Begin -->
        <!-- To move inline styles to css file/block, please specify a class name for each element. --> 
        <div id="slider1_container" style="position: relative; width: 600px;
             height: 300px;">

            <!-- Loading Screen -->
            <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                     background-color: #000; top: 0px; left: 0px;width: 100%;height:100%;">
                </div>
                <div style="position: absolute; display: block; background: url('<?php echo JURI::root(true); ?>components/com_ccgslider/assets/JssorSlider/img/loading.gif') no-repeat center center;
                     top: 0px; left: 0px;width: 100%;height:100%;">
                </div>
            </div>
            <!-- Slides Container -->
            <div id="jssorSlidesContainer" u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 600px; height: 300px;
                 overflow: hidden;">
            </div>

            <!--#region Thumbnail Navigator Skin Begin -->
            <!-- Help: http://www.jssor.com/development/slider-with-thumbnail-navigator-jquery.html -->
            <!-- thumbnail navigator container -->
            <div u="thumbnavigator" class="jssort09" style="position: absolute; bottom: 0px; left: 0px; height:60px; width:600px;">
                <div style="filter: alpha(opacity=40); opacity:0.4; position: absolute; display: block;
                     background-color: #ffffff; top: 0px; left: 0px; width: 100%; height: 100%;">
                </div>
                <!-- Thumbnail Item Skin Begin -->
                <div u="slides">
                    <div u="prototype" style="POSITION: absolute; WIDTH: 600px; HEIGHT: 60px; TOP: 0; LEFT: 0;">
                        <div u="thumbnailtemplate" style="font-family: verdana; font-weight: normal; POSITION: absolute; WIDTH: 100%; HEIGHT: 100%; TOP: 0; LEFT: 0; color:#000; line-height: 60px; font-size:20px; padding-left:10px;"></div>
                    </div>
                </div>
                <!-- Thumbnail Item Skin End -->
            </div>
            <!--#endregion ThumbnailNavigator Skin End -->

            <!--#region Bullet Navigator Skin Begin -->
            <!-- Help: http://www.jssor.com/development/slider-with-bullet-navigator-jquery.html -->
            <style>
                /* jssor slider bullet navigator skin 01 css */
                /*
                .jssorb01 div           (normal)
                .jssorb01 div:hover     (normal mouseover)
                .jssorb01 .av           (active)
                .jssorb01 .av:hover     (active mouseover)
                .jssorb01 .dn           (mousedown)
                */
                .jssorb01 {
                    position: absolute;
                }
                .jssorb01 div, .jssorb01 div:hover, .jssorb01 .av {
                    position: absolute;
                    /* size of bullet elment */
                    width: 12px;
                    height: 12px;
                    filter: alpha(opacity=70);
                    opacity: .7;
                    overflow: hidden;
                    cursor: pointer;
                    border: #000 1px solid;
                }
                .jssorb01 div { background-color: gray; }
                .jssorb01 div:hover, .jssorb01 .av:hover { background-color: #d3d3d3; }
                .jssorb01 .av { background-color: #fff; }
                .jssorb01 .dn, .jssorb01 .dn:hover { background-color: #555555; }
            </style>
            <!-- bullet navigator container -->
            <div u="navigator" class="jssorb01" style="bottom: 16px; right: 10px;">
                <!-- bullet navigator item prototype -->
                <div u="prototype"></div>
            </div>
            <!--#endregion Bullet Navigator Skin End -->

            <!--#region Arrow Navigator Skin Begin -->
            <!-- Help: http://www.jssor.com/development/slider-with-arrow-navigator-jquery.html -->
            <style>
                /* jssor slider arrow navigator skin 05 css */
                /*
                .jssora05l                  (normal)
                .jssora05r                  (normal)
                .jssora05l:hover            (normal mouseover)
                .jssora05r:hover            (normal mouseover)
                .jssora05l.jssora05ldn      (mousedown)
                .jssora05r.jssora05rdn      (mousedown)
                */
                .jssora05l, .jssora05r {
                    display: block;
                    position: absolute;
                    /* size of arrow element */
                    width: 40px;
                    height: 40px;
                    cursor: pointer;
                    background: url('JssorSlider/img/a17.png') no-repeat;
                    overflow: hidden;
                }
                .jssora05l { background-position: -10px -40px; }
                .jssora05r { background-position: -70px -40px; }
                .jssora05l:hover { background-position: -130px -40px; }
                .jssora05r:hover { background-position: -190px -40px; }
                .jssora05l.jssora05ldn { background-position: -250px -40px; }
                .jssora05r.jssora05rdn { background-position: -310px -40px; }
            </style>
            <!-- Arrow Left -->
            <span u="arrowleft" class="jssora05l" style="top: 123px; left: 8px;">
            </span>
            <!-- Arrow Right -->
            <span u="arrowright" class="jssora05r" style="top: 123px; right: 8px;">
            </span>
            <a style="display: none" href="http://www.jssor.com">Bootstrap Slider</a>
            <!-- Trigger -->
        </div>
        <!-- Jssor Slider End -->
    </div>
    <?php if($canEdit && $this->item->checked_out == 0): ?>
		<a class="btn" href="<?php echo JRoute::_('index.php?option=com_ccgslider&task=slider.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_CCGSLIDER_EDIT_ITEM"); ?></a>
	<?php endif; ?>
								<?php if(JFactory::getUser()->authorise('core.delete','com_ccgslider.slider.'.$this->item->id)):?>
									<a class="btn" href="<?php echo JRoute::_('index.php?option=com_ccgslider&task=slider.remove&id=' . $this->item->id, false, 2); ?>"><?php echo JText::_("COM_CCGSLIDER_DELETE_ITEM"); ?></a>
								<?php endif; ?>
    <?php
else:
    echo JText::_('COM_CCGSLIDER_ITEM_NOT_LOADED');
endif;
?>
