<?php

/**
 * This is the model class for table "course".
 *
 * The followings are the available columns in table 'course':
 * @property string $course_id
 * @property string $course_name
 *
 * The followings are the available model relations:
 * @property Actualclass[] $actualclasses
 * @property CourseBook[] $courseBooks
 * @property CourseMaterial[] $courseMaterials
 * @property LikeCourse[] $likeCourses
 */
class Course extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Course the static model class
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
		return 'course';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('course_id, course_name', 'required'),
			array('course_id', 'length', 'max'=>10),
			array('course_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('course_id, course_name', 'safe', 'on'=>'search'),
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
			'actualclasses' => array(self::HAS_MANY, 'Actualclass', 'course_id'),
			'courseBooks' => array(self::HAS_MANY, 'CourseBook', 'course_id'),
			'courseMaterials' => array(self::HAS_MANY, 'CourseMaterial', 'course_id'),
			'likeCourses' => array(self::HAS_MANY, 'LikeCourse', 'course_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'course_id' => 'Course',
			'course_name' => 'Course Name',
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

		$criteria->compare('course_id',$this->course_id,true);
		$criteria->compare('course_name',$this->course_name,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}