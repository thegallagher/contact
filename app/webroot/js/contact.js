(function ($) {
	var apiKey;
	var $iframe;
	
	var submit = function () {
		if (loadingFiles < 1) {
			var $form = $(this), method, format;
			if ($.support.cors) {
				method = $.post;
				format = 'json';
			} else {
				method = $.get;
				format = 'jsonp';
				//format = 'json';
			}
			
			$form.find('.error, .form_message').remove();
			
			var formData = $form.serializeArray();
			formData.push({'name': '_key', 'value': apiKey});
			
			if ($files.length > 0) {
				var attachFiles = {};
				var fileCount = 0;
				$files.each(function() {
					var $item = $(this);
					var field = $item.attr('name');
					var fileName = $item.data('file-name');
					var fileData = $item.data('file-data');
					if (field && fileName && fileData) {
						attachFiles[field] = {
							'name': fileName,
							'data': fileData
						};
						fileCount++;
					}
				});
				if (fileCount > 0) {
					formData.push({'name': '_files', 'value': $.param(attachFiles)});
				}
			}
			
			method($form.attr('action') + '.json', formData, function (data) {
				var className;
				if (data['result']) {
					className = 'form_message';
					$form.get(0).reset();
					$form.slideUp();
				} else {
					if (data['errors']) {
						$.each(data['errors'], function (index, value) {
							$form.find('[name="' + index + '"]').after('<div class="error">' + value + '</div>');
						});
					}
					className = 'form_message error';
				}
				$form.before('<div class="' + className + '">' + data['message'] + '</div>');
				$form.find('.error').hide().slideDown();
				$('.form_message').hide().slideDown();
			}, format);
		}
		return false;
	};
	
	var createIframe = function() {
		var $iframe = $('<iframe/>');
		$iframe.load(function() {console.log('frame load');});
		$iframe.attr({
			src: _contactSetup.iframeSrc,
			name: _contactSetup.uniqueId
		});
		$iframe.css('display', 'none');
		
		return $iframe;
	};
	
	var receiveMessage = function(e) {
		var oEvent = e.originalEvent;
		if (oEvent.origin != _contactSetup.origin || oEvent.otherWindow != $iframe.get(0).contentWindow) {
			return;
		}
		
		var message = jQuery.parseJSON(oEvent.message);
		if (!message || message.uniqueId != _contactSetup.uniqueId) {
			return;
		}
		
		$iframe.trigger(message.event, message.parameters);
	};
	
	$.fn.contact = function (key) {
		apiKey = key;
		this.submit(submit);
		$iframe = createIframe();
		this.attr('target', _contactSetup.uniqueId);
		$(window).on('message', receiveMessage);
	};
})(jQuery);