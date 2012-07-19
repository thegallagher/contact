<?php
App::uses('AppController', 'Controller');
/**
 * Forms Controller
 *
 * @property Form $Form
 */
class FormsController extends AppController {
	
	public $components = array('RequestHandler', 'MathCaptcha');
	
	public function options() {
		$this->autoRender = false;
		$this->response->header('Access-Control-Allow-Origin',	'*');
		$this->response->header('Access-Control-Allow-Headers',	'X-Requested-With');
	}
	
	public function send() {
		// Set CORS Headers
		$this->response->header('Access-Control-Allow-Origin',	'*');
		$this->response->header('Access-Control-Allow-Headers',	'X-Requested-With');
		
		//$this->set('_serialize', array('result', 'message', 'errors'));
		//$this->set('errors', array());
		
		if ($this->request->is('post')) {
			$formData = $this->data;
		} else {
			$formData = $_GET;
		}
		
		// JSONP
		$callback = false;
		if (isset($formData['callback'])) {
			$callback = $formData['callback'];
			unset($formData['callback']);
		}
		$this->set('callback', $callback);
		
		// Find the form
		$this->loadModel('ApiKey');
		$apiKey = $formData['_key'];
		$form = $this->ApiKey->getForm($apiKey);
			
		if ($form) {
			// Get allowed variables
			$data = array();
			if (!empty($form['Form']['allowed_vars'])) {
				$form['Form']['allowed_vars'][] = 'email';
				foreach ($form['Form']['allowed_vars'] as $var) {
					$data[$var] = isset($formData[$var]) ? $formData[$var] : null;
				}
			} else {
				foreach ($formData as $key => $val) {
					if (substr($key, 0, 1) != '_') {
						$data[$key] = $val;
					}
				}
			}
			
			// Check required variables
			$errors = array();
			$required = !empty($form['Form']['required_vars']) ? $form['Form']['required_vars'] : array();
			$required[] = 'email';
			foreach ($required as $var) {
				if (empty($data[$var])) {
					$errors[$var] = Inflector::humanize($var) . ' is required.';
				}
			}
			
			// Check attachments
			$attachments = array();
			if (isset($formData['_files'])) {
				parse_str($formData['_files'], $files);
				foreach ($files as $field => $file) {
					$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
					if ($this->_isValidFileExt($ext, $apiKey)) {
						$path = TMP . md5(uniqid('', true));
						$fileData = $this->_parseDataUri($file['data']);
						file_put_contents($path, $fileData['data']);
						$attachments[$field . '.' . $ext] = $path;
					} else {
						$errors[$field] = 'File type not allowed.';
					}
				}
			}
			
			if (!empty($errors)) {
				$this->set('errors', $errors);
				$this->set('result', false);
				$this->set('message', 'Please enter all required fields.');
			} else {
				// Create email
				App::uses('CakeEmail', 'Network/Email');
				$email = new CakeEmail();
				
				// From
				$email->from($this->_getEmail($data));
				
				// To
				$emails = array();
				foreach ($form['Contact'] as $contact) {
					if ($contact['is_active']) {
						$emails[] = $contact['email'];
					}
				}
				$email->to($emails);
				
				// Subject
				$email->subject($form['Form']['subject']);
				
				// Attachments
				$email->attachments($attachments);
				
				// Setup
				$data['title_for_layout'] = $form['Form']['subject'];
				$viewPath = APP_DIR . 'View' . DS . 'Emails' . DS . 'html' . DS . $form['Form']['id'] . '.ctp';
				$email->emailFormat('html');
				$email->template(file_exists($viewPath) ? $form['Form']['id'] : 'default');
				$email->viewVars($data);
				
				// Send
				$result = !!$email->send();
				if ($result) {
					$message = 'Your message has been sent. We will respond ASAP.';
				} else {
					$message = 'Your message could not be sent. Please try again later.';
				}
				$this->set('result', $result);
				$this->set('message', $message);
			}
		} else {
			$this->set('result', false);
			$this->set('message', 'Invalid API Key.');
		}
	}
	
	protected function _isValidFileExt($fileExt, $apiKey) {
		$fileExts = explode(',', 'pdf,docx?,txt,jpe?g,png,png,ai,psd,bmp,xlsx?,csv,zip,gz,rar,bz2,mp3,wav,xps');
		
		foreach ($fileExts as $ext) {
			if (preg_match('#' . preg_quote($ext, '#') . '#i', $fileExt) !== false) {
				return true;
			}
		}
		
		return false;
	}
	
	protected function _parseDataUri($uri) {
		preg_match('#data:([\w+.-]+?/[\w+.-]+?)?(?:;?charset\=([\w+.-]+?))?(;?base64)?,(.*)#i', $uri, $matches);
		
		if ($matches === false) {
			return false;
		}
		
		$data = $matches[3] == 'base64' ? base64_decode($matches[4]) : urldecode($matches[4]);
		$mimeType = empty($matches[1]) ? 'text/plain' : $matches[1];
		$encoding = empty($matches[2]) ? 'US-ASCII' : $matches[2];
		
		return compact('data', 'mimeType', 'encoding');
	}
	
	/*protected function _getEmail($data) {
		$keys = array('email', 'email_address', 'emailaddress');
		foreach ($keys as $key) {
			if (isset($data[$key])) {
				return $key;
			}
		}
		return $keys[0];
	}*/
	
	protected function _getName($data) {
		if (isset($data['name'])) {
			return $data['name'];
		}
		if (isset($data['first_name'])) {
			$name = $data['first_name'];
			if (isset($data['last_name'])) {
				$name .=  ' ' . $data['last_name'];
			}
			return $name;
		}
		return null;
	}
	
	protected function _getEmail($data) {
		if (!isset($data['email'])) {
			return null;
		}
		
		$name = $this->_getName($data);
		if ($name !== null) {
			return array($data['email'] => $name);
		} else {
			return array($data['email']);
		}
	}
	
	public function captcha() {
		$this->set('_serialize', array('result', 'message', 'question', 'key'));
		
		$this->loadModel('ApiKey');
		$apiKey = $this->request->data('_key');
		$form = $this->ApiKey->getForm($apiKey);
		
		if ($form) {
			App::uses('String', 'Utility');
			$key = String::uuid();
			$question = $this->MathCaptcha->makeCaptcha(false);
			$answer = $this->MathCaptcha->getResult();
			
			Cache::write($key, compact('question', 'answer'));
			$this->set(compact('key', 'question'));
			
		} else {
			$this->set('result', false);
			$this->set('message', 'Invalid API Key.');
		}
	}
}
