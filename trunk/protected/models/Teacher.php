<?php

/**
 * This is the model class for table "teacher".
 *
 * The followings are the available columns in table 'teacher':
 * @property string $teacher_id
 * @property string $teacher_name
 * @property integer $sex
 * @property string $introduction
 *
 * The followings are the available model relations:
 * @property Actualclass[] $actualclasses
 */
class Teacher extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Teacher the static model class
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
		return 'teacher';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('teacher_name', 'required'),
			array('sex', 'numerical', 'integerOnly'=>true),
			array('teacher_name', 'length', 'max'=>32),
			array('introduction', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('teacher_id, teacher_name, sex, introduction', 'safe', 'on'=>'search'),
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
			'actualclasses' => array(self::MANY_MANY, 'Actualclass', 'teaching(teacher_id, class_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'teacher_id' => 'Teacher',
			'teacher_name' => 'Teacher Name',
			'sex' => 'Sex',
			'introduction' => 'Introduction',
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

		$criteria->compare('teacher_id',$this->teacher_id,true);
		$criteria->compare('teacher_name',$this->teacher_name,true);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('introduction',$this->introduction,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}