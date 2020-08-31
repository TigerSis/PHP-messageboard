<?php
class input{
		function testData($data) {
			if($data==''){
				return false;
			}
			$bDatas=['拼多多','京东','唯品会','刘强东','马云','马化腾'];
			foreach($bDatas as $bData){
				if($data == $bData){
					return false;
				}
			}
			return true;
		}
	}
?>