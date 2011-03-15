<?php

/**
 * This is the model class for table "material".
 *
 * The followings are the available columns in table 'material':
 * @property string $material_id
 * @property string $material_name
 * @property string $material_path
 *
 * The followings are the available model relations:
 * @property CourseMaterial[] $courseMaterials
 */
class Material extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Material the static model class
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
		return 'material';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('material_name', 'length', 'max'=>128),
			array('material_path', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('material_id, material_name, material_path', 'safe', 'on'=>'search'),
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
			'courseMaterials' => array(self::HAS_MANY, 'CourseMaterial', 'material_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'material_id' => 'Material',
			'material_name' => 'Material Name',
			'material_path' => 'Material Path',
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

		$criteria->compare('material_id',$this->material_id,true);
		$criteria->compare('material_name',$this->material_name,true);
		$criteria->compare('material_path',$this->material_path,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}