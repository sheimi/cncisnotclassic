<?php

/**
 * This is the model class for table "actualclass".
 *
 * The followings are the available columns in table 'actualclass':
 * @property string $class_id
 * @property string $course_id
 * @property string $term
 * @property string $grade
 * @property double $credit
 * @property integer $period
 * @property string $course_type
 * @property string $major_id
 * @property string $site
 *
 * The followings are the available model relations:
 * @property Major $major
 * @property Course $course
 * @property Teacher[] $teachers
 * @property TimeSite[] $timeSites
 */
class Actualclass extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Actualclass the static model class
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
		return 'actualclass';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('course_id, term, grade, major_id', 'required'),
			array('period', 'numerical', 'integerOnly'=>true),
			array('credit', 'numerical'),
			array('course_id, term, grade, major_id', 'length', 'max'=>10),
			array('course_type', 'length', 'max'=>45),
			array('site', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('class_id, course_id, term, grade, credit, period, course_type, major_id, site', 'safe', 'on'=>'search'),
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
			'major' => array(self::BELONGS_TO, 'Major', 'major_id'),
			'course' => array(self::BELONGS_TO, 'Course', 'course_id'),
			'teachers' => array(self::MANY_MANY, 'Teacher', 'teaching(class_id, teacher_id)'),
			'timeSites' => array(self::HAS_MANY, 'TimeSite', 'class_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'class_id' => 'Class',
			'course_id' => 'Course',
			'term' => 'Term',
			'grade' => 'Grade',
			'credit' => 'Credit',
			'period' => 'Period',
			'course_type' => 'Course Type',
			'major_id' => 'Major',
			'site' => 'Site',
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

		$criteria->compare('class_id',$this->class_id,true);
		$criteria->compare('course_id',$this->course_id,true);
		$criteria->compare('term',$this->term,true);
		$criteria->compare('grade',$this->grade,true);
		$criteria->compare('credit',$this->credit);
		$criteria->compare('period',$this->period);
		$criteria->compare('course_type',$this->course_type,true);
		$criteria->compare('major_id',$this->major_id,true);
		$criteria->compare('site',$this->site,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}