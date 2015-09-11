<?php

interface Logger {
	public function open($settings = array());
	public function write($type, $line);
	public function close();
}