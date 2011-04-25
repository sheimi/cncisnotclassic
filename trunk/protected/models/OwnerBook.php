<?php

/**
 * This is the model class for table "owner_book".
 *
 * The followings are the available columns in table 'owner_book':
 * @property string $owner_book
 * @property string $owner_id
 * @property string $book_id
 * @property string $access
 * @property string $mark_time
 *
 * The followings are the available model relations:
 * @property Books $book
 * @property Users $owner
 */
class OwnerBook extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return OwnerBook the static model class
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
		return 'owner_book';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('owner_id, book_id, access', 'required'),
			array('owner_id, book_id', 'length', 'max'=>10),
			array('access', 'length', 'max'=>7),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('owner_book, owner_id, book_id, access, mark_time', 'safe', 'on'=>'search'),
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
			'book' => array(self::BELONGS_TO, 'Books', 'book_id'),
			'owner' => array(self::BELONGS_TO, 'Users', 'owner_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'owner_book' => 'Owner Book',
			'owner_id' => 'Owner',
			'book_id' => 'Book',
			'access' => 'Access',
			'mark_time' => 'Mark Time',
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

		$criteria->compare('owner_book',$this->owner_book,true);
		$criteria->compare('owner_id',$this->owner_id,true);
		$criteria->compare('book_id',$this->book_id,true);
		$criteria->compare('access',$this->access,true);
		$criteria->compare('mark_time',$this->mark_time,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}