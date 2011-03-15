<?php

/**
 * This is the model class for table "course_material".
 *
 * The followings are the available columns in table 'course_material':
 * @property string $c_m_id
 * @property string $course_id
 * @property string $material_id
 *
 * The followings are the available model relations:
 * @property Material $material
 * @property Course $course
 */
class CourseMaterial extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CourseMaterial the static model class
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
		return 'course_material';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('course_id, material_id', 'required'),
			array('course_id, material_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('c_m_id, course_id, material_id', 'safe', 'on'=>'search'),
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
			'material' => array(self::BELONGS_TO, 'Material', 'material_id'),
			'course' => array(self::BELONGS_TO, 'Course', 'course_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'c_m_id' => 'C M',
			'course_id' => 'Course',
			'material_id' => 'Material',
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

		$criteria->compare('c_m_id',$this->c_m_id,true);
		$criteria->compare('course_id',$this->course_id,true);
		$criteria->compare('material_id',$this->material_id,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}