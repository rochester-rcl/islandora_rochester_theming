<?php

/**
 * @file
 * This is the template file for the object page for newspaper
 *
 * Available variables:
 * - $islandora_content: A rendered vertical tabbed newspapper issue browser.
 * - $parent_collections: An array containing parent collection IslandoraFedoraObject(s).
 * - $description: Rendered metadata descripton for the object.
 * - $metadata: Rendered metadata display for the binary object.
 *
 * @see template_preprocess_islandora_newspaper()
 */
?>
<div class="islandora-newspaper-object islandora">
  <div class="islandora-newspaper-content-wrapper clearfix">
    <?php if ($islandora_content): ?>
      <div class="islandora-newspaper-content">
        <?php print $islandora_content; ?>
      </div>
    <?php endif; ?>
  </div>
  <div class="islandora-newspaper-metadata">
    <?php print $description; ?>
    <?php if ($parent_collections): ?>
      <div>
        <h2><?php print t('In collections'); ?></h2>
        <ul>
          <?php foreach ($parent_collections as $collection): ?>
        <li><?php print l($collection->label, "islandora/object/{$collection->id}"); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
    <?php print $metadata; ?>
  </div>
</div>

<script>
    (function ($) {
        
        var percentangeOfWindow = .75;
        //buffer to give the bottmo of the list so no scroll bar appears 
        //when big enough
        var listBuffer = 30;
         // Use jQuery with the shortcut:
        // Here we immediately call the function with jQuery as the parameter.
        $( document ).ready(function() {
            var $content = $(".vertical-tabs fieldset.vertical-tabs-pane");
            $.each($content, function(index, data){
                if($(data).css('display') === 'none'){
                    $(data).addClass('visually-hidden');
                }
            });
            
            $('.vertical-tab-button a').click(function(){
                
                
                var tabPosition = $(".vertical-tab-button.selected").offset().top;
                var containerPosition = $(".vertical-tabs").offset().top;
                var newMargin =  tabPosition - containerPosition ;
                $.each($content, function(index, data){
                    if($(data).css('display') === 'block'){
                        $(data)[0].style.setProperty( 'margin-top', newMargin + "px", 'important' );
                        //$("form-wrapper vertical-tabs-pane selected").css('margin-top',tabHeight);
                        $(data).removeClass('visually-hidden');
                        
                    } else {
                        $(data).addClass('visually-hidden');
                        $(data).removeClass('selected');
                    }                 
                });
            });
            
            var heightOfTabList = $(".vertical-tabs-list").height() + listBuffer;
            
            var viewportHeight = $( window ).height();
            var suggestedHeight = Math.round(viewportHeight * percentangeOfWindow);
            
            if( suggestedHeight > heightOfTabList){
                // make the tab list % height of the view port
                $(".vertical-tabs-list").height(heightOfTabList);
            } else {
                $(".vertical-tabs-list").height(suggestedHeight);
            }
            
        });
        $( window ).resize(function() {
            var heightOfTabList = $(".vertical-tabs-list").height() + listBuffer;
            var viewportHeight = $( window ).height();
            var suggestedHeight = Math.round(viewportHeight * percentangeOfWindow);
           
            if( suggestedHeight > heightOfTabList){
                // make the tab list % height of the view port
                $(".vertical-tabs-list").height(heightOfTabList);
            } else {
                $(".vertical-tabs-list").height(suggestedHeight);
            }
        });
    }(jQuery));
   

</script>    
    
