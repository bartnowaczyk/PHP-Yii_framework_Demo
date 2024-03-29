<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	private $rada;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = User::model()->findByAttributes(array('login'=>$this->username	));
		
		if($user===null){
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}		

		else if ($user->haslo !== crypt($this->password, $user->haslo)) {
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}
		else {
			$this->errorCode=self::ERROR_NONE;
			$this->setState('role', $user->rola);
			$this->setState('rada', $user->rada_id);			
			$this->rada = $user->rada_id;	
			$this->_id = $user->id;
		}	
		return !$this->errorCode;
	}
	public function getId(){
		return $this->_id;
	}
	
	public function getRada(){
		return $this->rada;
	}

	
}
