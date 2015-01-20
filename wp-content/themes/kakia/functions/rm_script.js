// implement JSON.stringify serialization
JSON.stringify = JSON.stringify || function (obj) {
    var t = typeof (obj);
    if (t != "object" || obj === null) {
        // simple data type
        if (t == "string") obj = '"'+obj+'"';
        return String(obj);
    }
    else {
        // recurse array or object
        var n, v, json = [], arr = (obj && obj.constructor == Array);
        for (n in obj) {
            v = obj[n]; t = typeof(v);
            if (t == "string") v = '"'+v+'"';
            else if (t == "object" && v !== null) v = JSON.stringify(v);
            json.push((arr ? "" : '"' + n + '":') + String(v));
        }
        return (arr ? "[" : "{") + String(json) + (arr ? "]" : "}");
    }
};

function removeSortRecord(thisParentLi, targetObj)
{
	jQuery('li#'+thisParentLi+'_sort').remove();
	var order = jQuery('#'+targetObj).sortable('toArray');
    jQuery('#'+targetObj+'_data').val(order);
}

function ppbBuildItem()
{
	jQuery("#content_builder_sort li a.ppb_remove").click(function(){
	    jQuery(this).parent('li').remove();
	});
	
	jQuery("#content_builder_sort li a.ppb_plus").click(function(){
	    var currentSize = jQuery(this).parent('li').attr('data-current-size');
	    var prev1Li = jQuery(this).parent('li').prev();
	    var prev2Li = prev1Li.prev();
	    var prev3Li = prev2Li.prev();
	    
	    if(currentSize == 'one_fourth' || currentSize == 'one_fourth last')
	    {
	    	if(prev1Li.attr('data-current-size')=='one_third' && prev2Li.attr('data-current-size')=='one_third')
	    	{
	    		jQuery(this).parent('li').addClass('one_third');
		    	jQuery(this).parent('li').attr('data-current-size', 'one_third last');
		    	jQuery(this).parent('li').find('.ppb_setting_columns').attr('value', 'one_third last');	

	    	}
	    	else if(prev1Li.attr('data-current-size')=='two_third')
	    	{
	    		jQuery(this).parent('li').addClass('one_third');
		    	jQuery(this).parent('li').attr('data-current-size', 'one_third last');
		    	jQuery(this).parent('li').find('.ppb_setting_columns').attr('value', 'one_third last');	

	    	}
	    	else
	    	{
		    	jQuery(this).parent('li').addClass('one_third');
		    	jQuery(this).parent('li').attr('data-current-size', 'one_third');
		    	jQuery(this).parent('li').find('.ppb_setting_columns').attr('value', 'one_third');	
	    	}
	    	
	    	jQuery(this).parent('li').removeClass('one_fourth');
	    }
	    else if(currentSize == 'one_third' || currentSize == 'one_third last')
	    {	
	    	if(prev1Li.attr('data-current-size')=='one_half')
	    	{
	    		jQuery(this).parent('li').addClass('one_half');
		    	jQuery(this).parent('li').attr('data-current-size', 'one_half last');
		    	jQuery(this).parent('li').find('.ppb_setting_columns').attr('value', 'one_half last');	

	    	}
	    	else
	    	{
		    	jQuery(this).parent('li').addClass('one_half');
		    	jQuery(this).parent('li').attr('data-current-size', 'one_half');
		    	jQuery(this).parent('li').find('.ppb_setting_columns').attr('value', 'one_half');	
	    	}
	    	
	    	jQuery(this).parent('li').removeClass('one_third');
	    }
	    else if(currentSize == 'one_half' || currentSize == 'one_half last')
	    {
	    	if(prev1Li.attr('data-current-size')=='one_third')
	    	{
	    		jQuery(this).parent('li').addClass('two_third');
		    	jQuery(this).parent('li').attr('data-current-size', 'two_third last');
		    	jQuery(this).parent('li').find('.ppb_setting_columns').attr('value', 'two_third last');	
	    	}
	    	else
	    	{
		    	jQuery(this).parent('li').addClass('two_third');
		    	jQuery(this).parent('li').attr('data-current-size', 'two_third');
		    	jQuery(this).parent('li').find('.ppb_setting_columns').attr('value', 'two_third');	
	    	}

	    	jQuery(this).parent('li').removeClass('one_half');
	    }
	    else if(currentSize == 'two_third' || currentSize == 'two_third last')
	    {
	    	jQuery(this).parent('li').addClass('one');
	    	jQuery(this).parent('li').attr('data-current-size', 'one');
	    	jQuery(this).parent('li').find('.ppb_setting_columns').attr('value', 'one');
	    	jQuery(this).parent('li').removeClass('two_third');
	    }
	    else if(currentSize == 'one')
	    {
	    	return false;
	    }
	    else
	    {
	    	return false;
	    }
	    
	    var containerWidth = jQuery('#content_builder_sort').width();
	    var oneFourthWidth = (containerWidth/4)-6-20;
	    var oneHalfWidth = (containerWidth/2)-6-20;
	    var oneThirdWidth = (containerWidth/3)-6-20;
	    var twoThirdWidth = ((containerWidth/3)*2)-6-20;
	    var oneWidth = (containerWidth)-6-20;
	    
	    jQuery('#content_builder_sort').find('li.one_fourth').css('width', oneFourthWidth+'px');
	    jQuery('#content_builder_sort').find('li.one_half').css('width', oneHalfWidth+'px');
	    jQuery('#content_builder_sort').find('li.one_third').css('width', oneThirdWidth+'px');
	    jQuery('#content_builder_sort').find('li.two_third').css('width', twoThirdWidth+'px');
	    jQuery('#content_builder_sort').find('li.one').css('width', oneWidth+'px');
	});
	
	jQuery("#content_builder_sort li a.ppb_minus").click(function(){
	    var currentSize = jQuery(this).parent('li').attr('data-current-size');
	    var prev1Li = jQuery(this).parent('li').prev();
	    var prev2Li = prev1Li.prev();
	    var prev3Li = prev2Li.prev();
	    
	    if(currentSize == 'one_fourth' || currentSize == 'one_fourth last')
	    {
	    	return false;
	    }
	    else if(currentSize == 'one_third' || currentSize == 'one_third last')
	    {
	    	if(prev1Li.attr('data-current-size')=='one_fourth' && prev2Li.attr('data-current-size')=='one_fourth' && prev3Li.attr('data-current-size')=='one_fourth')
	    	{
	    		jQuery(this).parent('li').addClass('one_fourth');
		    	jQuery(this).parent('li').attr('data-current-size', 'one_fourth last');
		    	jQuery(this).parent('li').find('.ppb_setting_columns').attr('value', 'one_fourth last');
	    	}
	    	else
	    	{
		    	jQuery(this).parent('li').addClass('one_fourth');
		    	jQuery(this).parent('li').attr('data-current-size', 'one_fourth');
		    	jQuery(this).parent('li').find('.ppb_setting_columns').attr('value', 'one_fourth');
	    	}
	    	
	    	jQuery(this).parent('li').removeClass('one_third');
	    }
	    else if(currentSize == 'one_half' || currentSize == 'one_half last')
	    {
	    	if(prev1Li.attr('data-current-size')=='one_third' && prev2Li.attr('data-current-size')=='one_third')
	    	{
	    		jQuery(this).parent('li').addClass('one_third');
		    	jQuery(this).parent('li').attr('data-current-size', 'one_third last');
		    	jQuery(this).parent('li').find('.ppb_setting_columns').attr('value', 'one_third last');	

	    	}
	    	else
	    	{
		    	jQuery(this).parent('li').addClass('one_third');
		    	jQuery(this).parent('li').attr('data-current-size', 'one_third');
		    	jQuery(this).parent('li').find('.ppb_setting_columns').attr('value', 'one_third');	
	    	}
	    	
	    	jQuery(this).parent('li').removeClass('one_half');
	    }
	    else if(currentSize == 'two_third' || currentSize == 'two_third last')
	    {
	    	if(prev1Li.attr('data-current-size')=='one_half')
	    	{
	    		jQuery(this).parent('li').addClass('one_half');
		    	jQuery(this).parent('li').attr('data-current-size', 'one_half last');
		    	jQuery(this).parent('li').find('.ppb_setting_columns').attr('value', 'one_half last');	

	    	}
	    	else
	    	{
		    	jQuery(this).parent('li').addClass('one_half');
		    	jQuery(this).parent('li').attr('data-current-size', 'one_half');
		    	jQuery(this).parent('li').find('.ppb_setting_columns').attr('value', 'one_half');	
	    	}
	    	
	    	jQuery(this).parent('li').removeClass('two_third');
	    }
	    else if(currentSize == 'one')
	    {
	    	if(prev1Li.attr('data-current-size')=='one_third')
	    	{
	    		jQuery(this).parent('li').addClass('two_third');
		    	jQuery(this).parent('li').attr('data-current-size', 'two_third last');
		    	jQuery(this).parent('li').find('.ppb_setting_columns').attr('value', 'two_third last');	
	    	}
	    	else
	    	{
		    	jQuery(this).parent('li').addClass('two_third');
		    	jQuery(this).parent('li').attr('data-current-size', 'two_third');
		    	jQuery(this).parent('li').find('.ppb_setting_columns').attr('value', 'two_third');	
	    	}
	    	
	    	jQuery(this).parent('li').removeClass('one');
	    }
	    else
	    {
	    	return false;
	    }
	    
	    var containerWidth = jQuery('#content_builder_sort').width();
	    var oneFourthWidth = (containerWidth/4)-6-20;
	    var oneHalfWidth = (containerWidth/2)-6-20;
	    var oneThirdWidth = (containerWidth/3)-6-20;
	    var twoThirdWidth = ((containerWidth/3)*2)-6-20;
	    var oneWidth = (containerWidth)-6-20;
	    
	    jQuery('#content_builder_sort').find('li.one_fourth').css('width', oneFourthWidth+'px');
	    jQuery('#content_builder_sort').find('li.one_half').css('width', oneHalfWidth+'px');
	    jQuery('#content_builder_sort').find('li.one_third').css('width', oneThirdWidth+'px');
	    jQuery('#content_builder_sort').find('li.two_third').css('width', twoThirdWidth+'px');
	    jQuery('#content_builder_sort').find('li.one').css('width', oneWidth+'px');
	});
	
	jQuery(".pp_fancybox").fancybox({
	    maxWidth	: 500,
	    maxHeight	: 500,
	    autoSize	: false,
	    closeClick	: false,
	    openEffect	: 'none',
	    closeEffect	: 'none',
	    helpers : {
	    	overlay : {
	            css : {
	                'background-color' : 'rgba(0, 0, 0, 0.8)'
	            }
	        }
	    },
	    onCancel: function(current, previous) {
	    	jQuery('#ppb_inline_current').attr('value', '');
	    }
	});
	
	jQuery("#content_builder_sort li a.ppb_edit").click(function(){
		var trigger = jQuery(this);
		var targetInline = trigger.attr('href');
		var currentItemData = jQuery('#'+trigger.attr('data-rel')).data('ppb_setting');
		var currentItemOBJ = jQuery.parseJSON(currentItemData);
		
		jQuery('#ppb_inline_current').attr('value', trigger.attr('data-rel'));
		jQuery(targetInline+" :input").each(function(){
			if(typeof jQuery(this).attr('id') != 'undefined')
			{
				 jQuery(this).attr('value', '');
			}
		});
		
		jQuery.each(currentItemOBJ, function(index, value) { 
		  	if(typeof jQuery('#'+index) != 'undefined')
			{
				jQuery('#'+index).val(decodeURI(value));
				
				if(jQuery('#'+index).className!='ppb_select')
				{
					jQuery.uniform.update('#'+index);
				}
			}
		});
	});
}
    
    jQuery(document).ready(function(){
    
    	jQuery('form#pp_form input[type="file"], form#pp_form textarea, form#pp_form select, form#pp_form button, #postbox-container-2 select').uniform();
    
		jQuery('#current_sidebar li a.sidebar_del').click(function(){
			if(confirm('Are you sure you want to delete this sidebar? (this can not be undone)'))
			{
				sTarget = jQuery(this).attr('href');
				sSidebar = jQuery(this).attr('rel');
				objTarget = jQuery(this).parent('li');
				
				jQuery.ajax({
  		    		type: 'POST',
  		    		url: sTarget,
  		    		data: 'sidebar_id='+sSidebar,
  		    		success: function(msg){ 
  		    			objTarget.fadeOut();
  		    		}
		    	});
			}
			
			return false;
		});
		
		jQuery('a.image_del').click(function(){
			if(confirm('Are you sure you want to delete this image? (this can not be undone)'))
			{
				sTarget = jQuery(this).attr('href');
				sFieldId = jQuery(this).attr('rel');
				objTarget = jQuery('#'+sFieldId+'_wrapper');
				
				jQuery.ajax({
  		    		type: 'POST',
  		    		url: sTarget,
  		    		data: 'field_id='+sFieldId,
  		    		success: function(msg){ 
  		    			jQuery('#'+sFieldId).attr('value', '');
  		    			objTarget.fadeOut();
  		    		}
		    	});
			}
			
			return false;
		});
		
		jQuery('#pp_advance_clear_cache').click(function(){
			if(confirm('Are you sure you want to clear all cache'))
			{
				sTarget = jQuery(this).attr('href');
				
				jQuery.ajax({
  		    		type: 'POST',
  		    		url: sTarget,
  		    		data: 'method=clear_cache',
  		    		success: function(msg){ 
  		    			jQuery('#pp_advance_clear_cache').html('Successfully cleared. Click here to clear cache files again');
  		    		}
		    	});
			}
			
			return false;
		});
		
		jQuery('#save_ppskin').click(function(){
			var skinName = prompt("Please enter skin name", "");
			if (skinName!=null && skinName!="")
			{
				jQuery('#pp_save_skin_name').attr('value', skinName);
				jQuery('#pp_save_skin_flg').attr('value', 1);
				return true;
			}
			else
			{
				return false;
			}
		});
		
		jQuery('.skin_activate').click(function(){
			if(confirm('Are you sure you want to switch to this skin. Your current settings will be lost (this can\'t be undone!)'))
			{
				sTarget = jQuery(this).attr('href');
				skinID = jQuery(this).attr('data-rel');
				
				jQuery.ajax({
  		    		type: 'POST',
  		    		url: sTarget,
  		    		data: 'method=activate_skin&skin_id='+skinID,
  		    		success: function(msg){
  		    			setTimeout(function() {
                          location.reload();
                        }, 1000); 
  		    		}
		    	});
			}
			
			return false;
		});
		
		jQuery(".skin_remove").click(function(){
			if(confirm('Are you sure you want to remove this skin. (this can\'t be undone!)'))
			{
				sTarget = jQuery(this).attr('href');
				skinID = jQuery(this).attr('data-rel');
				parentLi = jQuery(this).parent('li');

				jQuery.ajax({
  		    		type: 'POST',
  		    		url: sTarget,
  		    		data: 'method=remove_skin&skin_id='+skinID,
  		    		success: function(msg){ 
  		    			parentLi.fadeOut();
  		    		}
		    	});
			}
			
			return false;
		});
		
		jQuery('#pp_advance_restore_default').click(function(){
			if(confirm('Are you sure you want to restore theme default settings (this can\'t be undone!)'))
			{
				jQuery('#pp_restore_flg').attr('value', 1);
				return true;
			}
			else
			{
				return false;
			}
		});
		
		jQuery('#pp_panel a').click(function(){
			jQuery('#pp_panel a').removeClass('nav-tab-active');
			jQuery(this).addClass('nav-tab-active');
			
			jQuery('.rm_section').css('display', 'none');
			jQuery(jQuery(this).attr('href')).css('display', 'block');
			jQuery('#current_tab').val(jQuery(this).attr('href'));
			
			return false;
		});
		
		jQuery('.color_picker').each(function()
		{	
			var inputID = jQuery(this).attr('id');
			
			jQuery(this).ColorPicker({
				color: jQuery(this).val(),
				onShow: function (colpkr) {
					jQuery(colpkr).fadeIn(200);
					return false;
				},
				onHide: function (colpkr) {
					jQuery(colpkr).fadeOut(200);
					return false;
				},
				onChange: function (hsb, hex, rgb, el) {
					jQuery('#'+inputID).val('#' + hex);
					jQuery('#'+inputID+'_bg').css('backgroundColor', '#' + hex);
				}
			});	
			
			jQuery(this).css('width', '200px');
			jQuery(this).css('float', 'left');
		});
		
		jQuery('.iphone_checkboxes').iphoneStyle({
  			checkedLabel: 'YES',
  			uncheckedLabel: 'NO'
		});
		
		jQuery('.rm_section').css('display', 'none');
		
		if(self.document.location.hash != '')
		{
			jQuery('html, body').animate({scrollTop:0}, 'fast');
			jQuery('.nav-tab').removeClass('nav-tab-active');
			jQuery('a'+self.document.location.hash+'_a').addClass('nav-tab-active');
			jQuery('div'+self.document.location.hash).css('display', 'block');
			jQuery('#current_tab').val(self.document.location.hash);
		}
		else
		{
			jQuery('div#pp_panel_general').css('display', 'block');
		}
		
		jQuery( ".pp_sortable" ).sortable({
			create: function(event, ui) { 
				myCheckRel = jQuery(this).attr('rel');
			
				var order = jQuery(this).sortable('toArray');
            	jQuery('#'+myCheckRel).val(order);
			},
			update: function(event, ui) {
				myCheckRel = jQuery(this).attr('rel');
			
				var order = jQuery(this).sortable('toArray');
            	jQuery('#'+myCheckRel).val(order);
			}
		});
		jQuery( ".pp_sortable" ).disableSelection();
		
		jQuery(".pp_checkbox input").change(function(){
			myCheckId = jQuery(this).val();
			myCheckRel = jQuery(this).attr('rel');
			myCheckTitle = jQuery(this).attr('alt');
			
			if (jQuery(this).is(':checked')) { 
				jQuery('#'+myCheckRel).append('<li id="'+myCheckId+'_sort" class="ui-state-default">'+myCheckTitle+'</li>');
			} 
			else
			{
				jQuery('#'+myCheckId+'_sort').remove();
			}

			var order = jQuery('#'+myCheckRel).sortable('toArray');

            jQuery('#'+myCheckRel+'_data').val(order);
		});
		
		jQuery(".pp_sortable_button").click(function(){
			var targetSelect = jQuery('#'+jQuery(this).attr('data-rel'));
			
			myCheckId = targetSelect.find("option:selected").val();
			myCheckRel = targetSelect.find("option:selected").attr('data-rel');
			myCheckTitle = targetSelect.find("option:selected").attr('title');

			if (jQuery('#'+myCheckRel).children('li#'+myCheckId+'_sort').length == 0)
			{
				jQuery('#'+myCheckRel).append('<li id="'+myCheckId+'_sort" class="ui-state-default"><div class="title">'+myCheckTitle+'</div><a data-rel="'+myCheckRel+'" href="javascript:removeSortRecord(\''+myCheckId+'\', \''+myCheckRel+'\');" class="remove">x</a><br style="clear:both"/></li>');
				//jQuery('#'+myCheckId+'_sort').remove();
				
				var order = jQuery('#'+myCheckRel).sortable('toArray');
            	jQuery('#'+myCheckRel+'_data').val(order);
            }
            else
            {
            	alert('You have already added "'+myCheckTitle+'"');
            }
		});
		
		jQuery(".pp_sortable li a.remove").click(function(){
			jQuery(this).parent('li').remove();
			var order = jQuery('#'+jQuery(this).attr('data-rel')).sortable('toArray');
            jQuery('#'+jQuery(this).attr('data-rel')+'_data').val(order);
		});
		
		jQuery("#pp_font").change(function(){
			jQuery("#pp_font_family").attr('value', jQuery("#pp_font option:selected").attr('data-family'));
		
			var ppCufonFont = 'http://fonts.googleapis.com/css?family='+jQuery(this).val();
			jQuery('#google_fonts-css').attr('href', ppCufonFont);
			
			if(jQuery("#pp_font option:selected").attr('data-family') != '')
			{
				jQuery('#pp_sample_text').css('font-family', '"'+jQuery("#pp_font option:selected").attr('data-family')+'"');
			}
			else
			{
				jQuery('#pp_sample_text').css('font-family', 'Helvetica Neue');
			}
		});
		
		jQuery("#slide_type").change(function(){
			jQuery('.meta_wrapper').hide();
			var currentVal = jQuery(this).val();
			
			if(currentVal=="Image")
			{
				jQuery('#gallery_link_url_wrapper').fadeIn();
				jQuery('#slide_display_content_wrapper').fadeIn();
				jQuery('#slide_img_alt_wrapper').fadeIn();
			}
			else if(currentVal=="Youtube Video")
			{
				jQuery('#slide_video_id_wrapper').fadeIn();
			}
			else if(currentVal=="Vimeo Video")
			{
				jQuery('#slide_video_id_wrapper').fadeIn();
			}
			else if(currentVal=="Self-Hosted Video")
			{
				jQuery('#slide_mp4_url_wrapper').fadeIn();
			}
			else
			{
				jQuery('#gallery_link_url_wrapper').fadeIn();
				jQuery('#slide_display_content_wrapper').fadeIn();
				jQuery('#slide_img_alt_wrapper').fadeIn();
			}
		});
		
		jQuery("#portfolio_type").change(function(){
			jQuery('.meta_wrapper').hide();
			var currentVal = jQuery(this).val();
			
			if(currentVal=="Youtube Video")
			{
				jQuery('#portfolio_video_id_wrapper').fadeIn();
			}
			else if(currentVal=="Vimeo Video")
			{
				jQuery('#portfolio_video_id_wrapper').fadeIn();
			}
			else if(currentVal=="Self-Hosted Video")
			{
				jQuery('#portfolio_mp4_url_wrapper').fadeIn();
			}
			else if(currentVal=="External Link")
			{
				jQuery('#portfolio_link_url_wrapper').fadeIn();
			}
			else if(currentVal=="Portfolio Content" || currentVal=="AJAX Portfolio Content")
			{
				jQuery('#portfolio_gallery_id_wrapper').fadeIn();
			}
		});
		
		jQuery("input.upload_text").click(function() { jQuery(this).select(); } );
		
		jQuery('.pp_date').datepicker({
			dateFormat:'yy-mm-dd',
			numberOfMonths: 3,
			onSelect: function(){
				var myDate = new Date(this.value);
				var myDateRaw = myDate.setDate(myDate.getDate());
				jQuery('#'+jQuery(this).attr('id')+'_raw').attr('value', myDateRaw);
			}
		});
		
		jQuery('.pp_time').timePicker();
		
		var containerWidth = jQuery('#content_builder_sort').width();
		var oneFourthWidth = (containerWidth/4)-6-20;
		var oneHalfWidth = (containerWidth/2)-6-20;
		var oneThirdWidth = (containerWidth/3)-6-20;
		var twoThirdWidth = ((containerWidth/3)*2)-6-20;
		var oneWidth = (containerWidth)-6-20;
		
		jQuery('#content_builder_sort').find('li.one_fourth').css('width', oneFourthWidth+'px');
		jQuery('#content_builder_sort').find('li.one_half').css('width', oneHalfWidth+'px');
		jQuery('#content_builder_sort').find('li.one_third').css('width', oneThirdWidth+'px');
		jQuery('#content_builder_sort').find('li.two_third').css('width', twoThirdWidth+'px');
		jQuery('#content_builder_sort').find('li.one').css('width', oneWidth+'px');
		
		jQuery(window).resize(function(){
			var containerWidth = jQuery('#content_builder_sort').width();
			var oneFourthWidth = (containerWidth/4)-6-20;
			var oneHalfWidth = (containerWidth/2)-6-20;
			var oneThirdWidth = (containerWidth/3)-6-20;
			var twoThirdWidth = ((containerWidth/3)*2)-6-20;
			var oneWidth = (containerWidth)-6-20;
			
			jQuery('#content_builder_sort').find('li.one_fourth').css('width', oneFourthWidth+'px');
			jQuery('#content_builder_sort').find('li.one_half').css('width', oneHalfWidth+'px');
			jQuery('#content_builder_sort').find('li.one_third').css('width', oneThirdWidth+'px');
			jQuery('#content_builder_sort').find('li.two_third').css('width', twoThirdWidth+'px');
			jQuery('#content_builder_sort').find('li.one').css('width', oneWidth+'px');
		});
		
		ppbBuildItem();
		
		jQuery("#ppb_sortable_add_button").click(function(){
			var targetSelect = jQuery('#ppb_options');
			
			randomId = jQuery.now();
			myCheckId = targetSelect.find("option:selected").val();
			myCheckTitle = targetSelect.find("option:selected").attr('title');
			
			if(myCheckId != '')
			{
				var builderItemData = {};
				builderItemData.id = randomId;
				builderItemData.shortcode = myCheckId;
				builderItemData.ppb_text_title = myCheckTitle;
				var builderItemDataJSON = JSON.stringify(builderItemData);
	
				builderItem = '<li id="'+randomId+'" class="ui-state-default one_third '+myCheckId+'" data-current-size="one_third">';
				builderItem+= '<a href="javascript:;" class="ppb_plus button">+</a>';
				builderItem+= '<a href="javascript:;" class="ppb_minus button">-</a>';
				builderItem+= '<div class="title">'+myCheckTitle+'</div>';
				builderItem+= '<a href="javascript:;" class="ppb_remove">x</a>';
				builderItem+= '<a data-rel="'+randomId+'" href="#ppb_inline_'+myCheckId+'" class="pp_fancybox ppb_edit">X</a>';
				builderItem+= '<input type="hidden" class="ppb_setting_columns" value="one_fourth"/>';
				builderItem+= '</li>';
	
				jQuery('#content_builder_sort').append(builderItem);
				ppbBuildItem();
				jQuery('#'+randomId).data('ppb_setting', builderItemDataJSON);
				
				var prev1Li = jQuery('#'+randomId).prev();
			    var prev2Li = prev1Li.prev();
			    var prev3Li = prev2Li.prev();
			    
			    if(prev1Li.attr('data-current-size')=='one_third' && prev2Li.attr('data-current-size')=='one_third')
		    	{
			    	jQuery('#'+randomId).attr('data-current-size', 'one_third last');
			    	jQuery('#'+randomId).find('.ppb_setting_columns').attr('value', 'one_third last');	
	
		    	}
				
				if(myCheckId!='ppb_divider')
				{
					jQuery('#'+randomId).find('.ppb_edit').trigger('click');
				}
			}
			
			return false;
		});
		
		jQuery(".ppb_inline_save").click(function(){
			var targetItem = jQuery('#ppb_inline_current').attr('value');
			var parentInline = jQuery(this).attr('data-parent');
			var currentItemData = jQuery('#'+targetItem).find('.ppb_setting_data').attr('value');
			var currentShortcode = jQuery('#'+parentInline).attr('data-shortcode');
			
			var itemData = {};
			itemData.id = targetItem;
			itemData.shortcode = currentShortcode;
			
			jQuery("#"+parentInline+" :input").each(function(){
			 	if(typeof jQuery(this).attr('id') != 'undefined')
			 	{
			 		itemData[jQuery(this).attr('id')] = encodeURI(jQuery(this).attr('value'));
				 	
				 	if(jQuery(this).attr('data-attr') == 'title')
				 	{
					 	jQuery('#'+targetItem).find('.title').html(decodeURI(jQuery(this).attr('value')));
				 	}
			 	}
			});
			
			var currentItemDataJSON = JSON.stringify(itemData);
			jQuery('#'+targetItem).data('ppb_setting', currentItemDataJSON);
			
			jQuery.fancybox.close();
		});
		
		jQuery('#post').submit(function() {
			jQuery("#content_builder_sort > li").each(function(){
				jQuery(this).append('<textarea style="display:none" id="'+jQuery(this).attr('id')+'_data" name="'+jQuery(this).attr('id')+'_data">'+jQuery(this).data('ppb_setting')+'</textarea>');
				jQuery(this).append('<input style="display:none" type="text" id="'+jQuery(this).attr('id')+'_size" name="'+jQuery(this).attr('id')+'_size" value="'+jQuery(this).attr('data-current-size')+'"/>');
			});
			
			var itemOrder = jQuery("#content_builder_sort").sortable('toArray');
			jQuery('#ppb_form_data_order').attr('value', itemOrder);
			//return false;
			
		});
		
		jQuery( ".ppb_sortable" ).sortable({
			start: function(event, ui) {
		        
		    },
		    stop: function(event, ui) {
		        
		    }
		});
		jQuery( ".ppb_sortable" ).disableSelection();
		
});