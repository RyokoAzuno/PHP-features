<?php
class User
{
	public $name = 'Mike';
	private $age = '25';
}

$user = new User;
print_r($user->name);
//*** First way ReflectionClass and ReflectionObject
//$reflection = new ReflectionClass(get_class($user));
//$secret = $reflection->getProperty('age');
//$secret->setAccessible(true);
//print_r($secret->getValue($user));
//*** Second way
//$propname="\0User\0age";
//$a = (array) $user;
//echo $a[$propname];
//*** Third way Closure call and bindTo
//$getUserAge = function() {
//    return $this->age;
//};
//echo $getUserAge->call($user);
//*** All properties
//$Arr = (array)$user;
//print_r ( $Arr );
?>