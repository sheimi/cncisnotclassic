<?php

/**
 * This is the model class for table "departments".
 *
 * The followings are the available columns in table 'departments':
 * @property string $dep_id
 * @property string $dep_name
 *
 * The followings are the available model relations:
 * @property Major[] $majors
 */
class Departments extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Departments the static model class
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
		return 'departments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dep_name', 'required'),
			array('dep_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('dep_id, dep_name', 'safe', 'on'=>'search'),
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
			'majors' => array(self::HAS_MANY, 'Major', 'dep_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'dep_id' => 'Dep',
			'dep_name' => 'Dep Name',
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

		$criteria->compare('dep_id',$this->dep_id,true);
		$criteria->compare('dep_name',$this->dep_name,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}