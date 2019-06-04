<?php
class Mail{

	public function getMail($page = 1)
	{ 
		$number = gettype($_POST['page']);
		if($number == "NULL")
		{
			$number = 1;
		}
		$arr1 = array();
		$arr1[0]="subject";
		$arr1[1]="problem";
		$arr1[2]="file_name";
		$arr1[3]="is_read";
		$arr2 = array();
		$query = new Query();
		$result = $query->_Select('user_messages', $arr1, $arr2, true);
		$post=array();
		$o=0;
		for($i=count($result)-1; $i>70; $i--)
		{			
			$key = $result[$i]['is_read'];
			$key .= $result[$i]['subject'];
			$value = $result[$i]['problem'];
			if($result[$i]['file_name']){
			$value .= " Приложенный файл: ".$result[$i]['file_name'];
			}
			$post[$o][$key] = $value;
			$o++;
		}
		return $post;
	}

	public function getPage(){
		
	}
	
}
?>