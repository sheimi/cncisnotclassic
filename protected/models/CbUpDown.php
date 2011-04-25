<?php

/**
 * This is the model class for table "cb_up_down".
 *
 * The followings are the available columns in table 'cb_up_down':
 * @property string $cb_up_down_id
 * @property string $member_id
 * @property string $cb_id
 * @property string $add_time
 * @property string $updown
 *
 * The followings are the available model relations:
 * @property Users $member
 * @property CourseBook $cb
 */
class CbUpDown extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CbUpDown the static model class
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
		return 'cb_up_down';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('member_id, cb_id', 'required'),
			array('member_id, cb_id', 'length', 'max'=>10),
			array('updown', 'length', 'max'=>4),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cb_up_down_id, member_id, cb_id, add_time, updown', 'safe', 'on'=>'search'),
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
			'cb' => array(self::BELONGS_TO, 'CourseBook', 'cb_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cb_up_down_id' => 'Cb Up Down',
			'member_id' => 'Member',
			'cb_id' => 'Cb',
			'add_time' => 'Add Time',
			'updown' => 'Updown',
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

		$criteria->compare('cb_up_down_id',$this->cb_up_down_id,true);
		$criteria->compare('member_id',$this->member_id,true);
		$criteria->compare('cb_id',$this->cb_id,true);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('updown',$this->updown,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}