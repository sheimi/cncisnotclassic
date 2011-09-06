<?php

/**
 * This is the model class for table "like_course".
 *
 * The followings are the available columns in table 'like_course':
 * @property string $like_course_id
 * @property string $member_id
 * @property string $course_id
 * @property string $add_time
 * @property string $star
 *
 * The followings are the available model relations:
 * @property Users $member
 * @property Course $course
 */
class LikeCourse extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return LikeCourse the static model class
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
		return 'like_course';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('member_id, course_id, star', 'required'),
			array('member_id, course_id, star', 'length', 'max'=>10),
			array('add_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('like_course_id, member_id, course_id, star', 'safe', 'on'=>'search'),
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
			'member' => array(self::BELONGS_TO, 'Users', 'member_id'),
			'course' => array(self::BELONGS_TO, 'Course', 'course_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'like_course_id' => 'Like Course',
			'member_id' => 'Member',
			'course_id' => 'Course',
			'add_time' => 'Add Time',
			'star' => 'Star',
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

		$criteria->compare('like_course_id',$this->like_course_id,true);
		$criteria->compare('member_id',$this->member_id,true);
		$criteria->compare('course_id',$this->course_id,true);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('star',$this->star,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}