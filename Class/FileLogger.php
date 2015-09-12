<?php

class FileLogger implements Logger {

	private $fh;
	private $logFileName = 'metapod-log.txt';
	private $logDirectory = 'logs';

	public function open( $settings = array() ){

		$filePath = METAPOD_DIRECTORY . DS .  $this->logDirectory . DS . $this->logFileName;

		if(!file_exists($filePath)){
			throw new exception('Log file does not exist.');
		}

		if(!is_writable($filePath)){
			throw new exception('Log file is not writable');
		}

		if(!$this->fh){
			$this->fh = fopen($this->logFileName, 'a+');
		}

		return $this->fh;
	}

	public function write($type, $line){
		if(!$this->fh){
			$this->open();
		}
		
		return fwrite($this->fh, $line . "\n");
	}

	public function close(){
		return fclose($this->fh);
	}
}