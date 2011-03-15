<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	private $_user_id;
	public function authenticate()
	{
		$users = array (// username => password
		'demo' => 'demo', 'admin' => 'admin', 'javoft' => 'j' );
		
		$record = Users::model ()->findByAttributes ( array ('username' => $this->username ) );
		if ($record === null)
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		/**
		 * @todo 此处密码暂未使用md5加密
		 */
		else if ($record->password !== $this->password)
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_user_id = $record->user_id;
			$this->setState ( 'username', $record->username );
			$this->errorCode = self::ERROR_NONE;
		}
		return ! $this->errorCode;
	}
}