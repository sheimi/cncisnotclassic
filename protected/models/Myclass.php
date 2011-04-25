<?php

/**
 * This is the model class for table "myclass".
 *
 * The followings are the available columns in table 'myclass':
 * @property string $myclass_id
 * @property string $class_name
 * @property integer $day
 * @property string $classroom
 * @property string $week_info
 * @property string $member_id
 * @property string $actualclass_id
 * @property integer $time
 * @property string $custom
 *
 * The followings are the available model relations:
 * @property Users $member
 */
class Myclass extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Myclass the static model class
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
		return 'myclass';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('day, classroom, member_id, actualclass_id, time', 'required'),
			array('day, time', 'numerical', 'integerOnly'=>true),
			array('class_name, classroom', 'length', 'max'=>64),
			array('week_info', 'length', 'max'=>6),
			array('member_id, actualclass_id', 'length', 'max'=>10),
			array('custom', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('myclass_id, class_name, day, classroom, week_info, member_id, actualclass_id, time, custom', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'myclass_id' => 'Myclass',
			'class_name' => 'Class Name',
			'day' => 'Day',
			'classroom' => 'Classroom',
			'week_info' => 'Week Info',
			'member_id' => 'Member',
			'actualclass_id' => 'Actualclass',
			'time' => 'Time',
			'custom' => 'Custom',
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

		$criteria->compare('myclass_id',$this->myclass_id,true);
		$criteria->compare('class_name',$this->class_name,true);
		$criteria->compare('day',$this->day);
		$criteria->compare('classroom',$this->classroom,true);
		$criteria->compare('week_info',$this->week_info,true);
		$criteria->compare('member_id',$this->member_id,true);
		$criteria->compare('actualclass_id',$this->actualclass_id,true);
		$criteria->compare('time',$this->time);
		$criteria->compare('custom',$this->custom,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}