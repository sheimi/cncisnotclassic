<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property string $user_id
 * @property string $bbs_name
 * @property string $major_id
 * @property string $email
 * @property string $grade
 * @property string $njuid
 * @property string $real_name
 * @property string $username
 * @property string $password
 * @property string $avatar_path
 *
 * The followings are the available model relations:
 * @property Bookcomment[] $bookcomments
 * @property BvHistory[] $bvHistories
 * @property CbUpDown[] $cbUpDowns
 * @property Feedback[] $feedbacks
 * @property KeepPrivate $keepPrivate
 * @property LikeCourse[] $likeCourses
 * @property Myclass[] $myclasses
 * @property OwnerBook[] $ownerBooks
 * @property Major $major
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('major_id, grade, password', 'required'),
			array('bbs_name, email, real_name, username', 'length', 'max'=>32),
			array('major_id, grade', 'length', 'max'=>10),
			array('njuid', 'length', 'max'=>15),
			array('password', 'length', 'max'=>40),
			array('avatar_path', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, bbs_name, major_id, email, grade, njuid, real_name, username, password, avatar_path', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'bookcomments' => array(self::HAS_MANY, 'Bookcomment', 'user_id'),
			'bvHistories' => array(self::HAS_MANY, 'BvHistory', 'user_id'),
			'cbUpDowns' => array(self::HAS_MANY, 'CbUpDown', 'member_id'),
			'feedbacks' => array(self::HAS_MANY, 'Feedback', 'member_id'),
			'keepPrivate' => array(self::HAS_ONE, 'KeepPrivate', 'user_id'),
			'likeCourses' => array(self::HAS_MANY, 'LikeCourse', 'member_id'),
			'myclasses' => array(self::HAS_MANY, 'Myclass', 'member_id'),
			'ownerBooks' => array(self::HAS_MANY, 'OwnerBook', 'owner_id'),
			'major' => array(self::BELONGS_TO, 'Major', 'major_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'bbs_name' => 'Bbs Name',
			'major_id' => 'Major',
			'email' => 'Email',
			'grade' => 'Grade',
			'njuid' => 'Njuid',
			'real_name' => 'Real Name',
			'username' => 'Username',
			'password' => 'Password',
			'avatar_path' => 'Avatar Path',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('bbs_name',$this->bbs_name,true);
		$criteria->compare('major_id',$this->major_id,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('grade',$this->grade,true);
		$criteria->compare('njuid',$this->njuid,true);
		$criteria->compare('real_name',$this->real_name,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('avatar_path',$this->avatar_path,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}