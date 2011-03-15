<?php

/**
 * This is the model class for table "major".
 *
 * The followings are the available columns in table 'major':
 * @property string $major_id
 * @property string $dep_id
 * @property string $major_name
 *
 * The followings are the available model relations:
 * @property Actualclass[] $actualclasses
 * @property Departments $dep
 * @property Users[] $users
 */
class Major extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Major the static model class
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
		return 'major';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('major_id, dep_id, major_name', 'required'),
			array('major_id', 'length', 'max'=>10),
			array('dep_id', 'length', 'max'=>5),
			array('major_name', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('major_id, dep_id, major_name', 'safe', 'on'=>'search'),
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
			'actualclasses' => array(self::HAS_MANY, 'Actualclass', 'major_id'),
			'dep' => array(self::BELONGS_TO, 'Departments', 'dep_id'),
			'users' => array(self::HAS_MANY, 'Users', 'major_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'major_id' => 'Major',
			'dep_id' => 'Dep',
			'major_name' => 'Major Name',
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

		$criteria->compare('major_id',$this->major_id,true);
		$criteria->compare('dep_id',$this->dep_id,true);
		$criteria->compare('major_name',$this->major_name,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}