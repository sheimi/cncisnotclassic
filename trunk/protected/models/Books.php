<?php

/**
 * This is the model class for table "books".
 *
 * The followings are the available columns in table 'books':
 * @property string $book_id
 * @property string $book_name
 * @property string $isbn
 * @property string $provider
 *
 * The followings are the available model relations:
 * @property Users $provider0
 * @property CourseBook[] $courseBooks
 */
class Books extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Books the static model class
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
		return 'books';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('provider', 'required'),
			array('book_name', 'length', 'max'=>128),
			array('isbn', 'length', 'max'=>32),
			array('provider', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('book_id, book_name, isbn, provider', 'safe', 'on'=>'search'),
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
			'provider0' => array(self::BELONGS_TO, 'Users', 'provider'),
			'courseBooks' => array(self::HAS_MANY, 'CourseBook', 'book_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'book_id' => 'Book',
			'book_name' => 'Book Name',
			'isbn' => 'Isbn',
			'provider' => 'Provider',
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

		$criteria->compare('book_id',$this->book_id,true);
		$criteria->compare('book_name',$this->book_name,true);
		$criteria->compare('isbn',$this->isbn,true);
		$criteria->compare('provider',$this->provider,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}