(function ($) {
	var apiKey;
	var $form;
	var $iframe;
	
	// Setup the form
	$.fn.contact = function (key) {
		apiKey = key;
		$form = this;
		$form.submit(submit);
		$iframe = createIframe();
		$(window).on('message', receiveMessage);
		$iframe.on('result', result);
	};
	
	// Create a new iframe for sending and receiving
	var createIframe = function() {
		var $iframe = $('<iframe/>');
		$iframe.load(function() {console.log('frame load');});
		$iframe.attr({
			src: _contactSetup.iframeSrc,
			name: _contactSetup.uniqueId
		});
		$iframe.css('display', 'none');
		$iframe.appendTo('body');
		
		return $iframe;
	};
	
	// Send the API key and unique id with the form
	var submit = function() {
		var $messages = $form.find('.error').add('.form_message');
		$messages.slideUp('fast', function() {
			$messages.remove();
		});
		
		var $keyInput = $form.find('input[name="_key"]');
		if ($keyInput.length < 1) {
			$keyInput = $('<input/>');
			$keyInput.attr({
				type: 'hidden',
				name: '_key'
			});
			$keyInput.appendTo($form);
		}
		$keyInput.val(apiKey);
		
		var $uidInput = $form.find('input[name="_uniqueId"]');
		if ($uidInput.length < 1) {
			$uidInput = $('<input/>');
			$uidInput.attr({
				type: 'hidden',
				name: '_uniqueId'
			});
			$uidInput.appendTo($form);
		}
		$uidInput.val(_contactSetup.uniqueId);
		
		if ($form.find('input[type="file"]').length > 0) {
			$form.attr('enctype', 'multipart/form-data');
		}
		
		$form.attr({
			method: 'post',
			target: _contactSetup.uniqueId
		});
		
		return true;
	};
	
	// When a message is received by this window and it is expected then trigger an event
	var receiveMessage = function(e) {
		var oEvent = e.originalEvent;
		if (oEvent.origin != _contactSetup.origin) {
			return;
		}
		
		var data = $.parseJSON(oEvent.data);
		if (!data || data.uniqueId != _contactSetup.uniqueId) {
			return;
		}
		
		var newEvent = new $.Event(data.event, {parameters: data.parameters});
		$iframe.trigger(newEvent);
	};
	
	// Event called when 'result' message received
	var result = function(event) {
		var className;
		if (event.parameters.result) {
			className = 'form_message';
			$form.get(0).reset();
			$form.slideUp();
		} else {
			if (event.parameters.errors) {
				$.each(event.parameters.errors, function (index, value) {
					$form.find('[name="' + index + '"]').after('<div class="error">' + value + '</div>');
				});
			}
			className = 'form_message error';
		}
		$form.before('<div class="' + className + '">' + event.parameters.message + '</div>');
		$form.find('.error').hide().slideDown();
		$('.form_message').hide().slideDown();
	};
})(jQuery);