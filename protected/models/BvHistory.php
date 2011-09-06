<?php

/**
 * This is the model class for table "bv_history".
 *
 * The followings are the available columns in table 'bv_history':
 * @property string $bv_history_id
 * @property string $book_id
 * @property string $user_id
 * @property string $time
 *
 * The followings are the available model relations:
 * @property Books $book
 * @property Users $user
 */
class BvHistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return BvHistory the static model class
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
		return 'bv_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('book_id, user_id', 'required'),
			array('book_id, user_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('bv_history_id, book_id, user_id, time', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'bv_history_id' => 'Bv History',
			'book_id' => 'Book',
			'user_id' => 'User',
			'time' => 'Time',
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

		$criteria->compare('bv_history_id',$this->bv_history_id,true);
		$criteria->compare('book_id',$this->book_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('time',$this->time,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}